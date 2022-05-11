<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Pluralizer;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use DataTables;

class MediaController extends Controller
{
    protected $channel;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->channel = Auth::user()->channels()->first();

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws \Exception
     */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$instance = Media::latest()->get();
			return DataTables::of($instance)
			                 ->addIndexColumn()
			                 ->editColumn('type', function ($row) {
				                 return '<span class="badge badge-sm">' . $row->type . '</span>';
			                 })
			                 ->editColumn('size', function ($row) {
				                 return formatFromBytes($row->size);
			                 })
			                 ->editColumn('extension', function ($row) {
				                 return '<span class="badge badge-sm badge-secondary text-lowercase">' . $row->extension . '</span>';
			                 })
			                 ->editColumn('duration', function ($row) {
				                 if ($row->duration){
					                 return CarbonInterval::seconds($row->duration)->cascade()->format('%H:%I:%s');
                                 }

				                 return '-';
			                 })
			                 ->editColumn('created_at', function ($row) {
				                 return $row->created_at->diffForHumans();
			                 })
			                 ->addColumn('actions', function ($row) {
				                 return
					                 '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url="' . route('channel.media.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['type', 'size', 'extension', 'created_at', 'actions'])
			                 ->make(true);
		}
		
		return view('channel.media.index');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */

	 public function store(FileReceiver $fileReceiver)
	{
		// Check if the upload is not success throw exception else return response you need
		if ($fileReceiver->isUploaded() === false) {
			return response()->json([
				'status' => false,
				'message' => 'Something went wrong while uploading!',
			]);
		}
		
		// Receive the chunked file
		$chunk = $fileReceiver->receive();
		
		// Check if the upload has finished (in chunk mode it will send smaller files)
		if ($chunk->isFinished()) {
			$file = $chunk->getFile();
			
			// Create proper filename
			$filename = $this->createFilename($file);

            $directory = 'media';

            // Name directory based on mimetype
			switch ($file->getMimeType()) {
				case 'video/mp4':       // mp4
				case 'video/webm':      // webm
				case 'video/x-ms-asf':  // wmv
				case 'video/x-ms-wmv':  // wmv
				case 'video/ogg':       // ogg
				case 'video/x-msvideo': // avi
				case 'video/quicktime': // mov
				case 'video/x-flv':     // flv
				case 'video/x-matroska':// mkv
					$disk = 'private';
					break;
				
				case 'image/jpeg':
				case 'image/gif':
				case 'image/png':
				case 'image/bmp':
				case 'image/svg+xml':
				case 'text/vtt':
				case 'text/plain':
					$disk = 'public';
					break;
			}

	
			$data = [
                'channel_id' => '1',
				'title' => $file->getClientOriginalName(),
				'type' => $file->getMimeType(),
				'size' => $file->getSize(),
				'extension' => $file->getClientOriginalExtension(),
				'path' => $directory . '/' . $filename,
			];

			$path = storage_path("app/$disk/$directory");
			$file->move($path, $filename);

			// Move file with new name to path

			// If media is video, get media duration

			// if($disk === 'private'){
			// 	$data['duration'] = FFMpeg::open($disk . '/' . $directory . '/' . $filename)->getDurationInSeconds();
			// }
			
			// Create media
			Media::create($data);

			return response()->json([
				'status' => true,
				'uploaded' => true,
			]);
		}
		
		// We are in chunk mode, lets send the current progress
		$handler = $chunk->handler();
		
		return response()->json([
			'status' => true,
			'progress' => $handler->getPercentageDone(),
		]);
		
	}
	
	/**
	 * Create unique filename for uploaded file
	 * @param  UploadedFile $file
	 * @return string
	 */
	protected function createFilename(UploadedFile $file)
	{
		$extension = $file->getClientOriginalExtension();
		$filename = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension
		
		// Add timestamp hash to name of the file
		$filename .= "_" . md5(time()) . "." . $extension;
		
		return $filename;
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Media $media
	 * @return Response
	 */
	public function edit(Media $media)
	{
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Media        $media
	 * @return Response
	 */
	public function update(Request $request, Media $media)
	{
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Media $media
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id)
	{
        $media = Media::findOrFail($id);

		switch ($media->type) {
			case 'application/octet-stream':
				Storage::disk('public')->delete($media->path);
				break;
			
			default:
				Storage::disk('private')->delete($media->path);
				break;
		}
		
		$media->delete();
		
		return response()->json([
			'status' => true,
			'message' => 'Successfully deleted!',
		]);
	}
}
