<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class EpisodeController extends Controller
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
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			// $instance = $this->channel->episodes()->latest();
			$instance = Episode::latest();
			return DataTables::of($instance)
			                 ->addIndexColumn()
			                 ->editColumn('show_id', function ($row) {
				                 return $row->show->title ?? 'Undefined';
			                 })
			                 ->editColumn('season_id', function ($row) {
				                 return $row->season->title ?? 'Undefined';
			                 })
			                 ->editColumn('description', function ($row) {
				                 return Str::limit($row->description, 50);
			                 })
			                 ->addColumn('poster', function ($row) {
				                 $media = $row->media()->poster('episode')->first();
				
				                 if (!empty($media)) {
					                 return '<img src="' . asset('storage/' . $media->path) . '" class="img-fluid img-thumbnail">';
				                 }
				
				                 return 'Undefined';
			                 })
			                 ->editColumn('download', function ($row) {
				                 switch ($row->download === 1) {
					                 case true:
						                 return '<span class="badge badge-sm badge-success">Yes</span>';
					
					                 default:
						                 return '<span class="badge badge-sm badge-dark">No</span>';
				                 }
			                 })
			                 ->editColumn('subtitles', function ($row) {
				                 switch ($row->subtitles === 1) {
					                 case true:
						                 return '<span class="badge badge-sm badge-success">Yes</span>';
					
					                 default:
						                 return '<span class="badge badge-sm badge-dark">No</span>';
				                 }
			                 })
			                 ->editColumn('upcoming', function ($row) {
				                 switch ($row->upcoming === 1) {
					                 case true:
						                 return '<span class="badge badge-sm badge-success">Yes</span>';
					
					                 default:
						                 return '<span class="badge badge-sm badge-dark">No</span>';
				                 }
			                 })
			                 ->editColumn('premium', function ($row) {
				                 switch ($row->premium === 1) {
					                 case true:
						                 return '<span class="badge badge-sm badge-success">Yes</span>';
					
					                 default:
						                 return '<span class="badge badge-sm badge-dark">No</span>';
				                 }
			                 })
			                 ->editColumn('status', function ($row) {
				                 switch ($row->status === 1) {
					                 case true:
						                 return '<span class="badge badge-sm badge-success">Published</span>';
					
					                 default:
						                 return '<span class="badge badge-sm badge-warning">Unpublished</span>';
				                 }
			                 })
			                 ->editColumn('created_at', function ($row) {
				                 return $row->created_at->diffForHumans();
			                 })
			                 ->addColumn('actions', function ($row) {
				                 $status = $row->status === 1 ?
					                 '<a href="#!" data-url="' . route('channel.episodes.unpublish', $row->id) . '" class="btn-toggle dropdown-item">Unpublish</a>' :
					                 '<a href="#!" data-url="' . route('channel.episodes.publish', $row->id) . '" class="btn-toggle dropdown-item">Publish</a>';
				
				                 return
					                 '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('channel.episodes.edit', $row->id) . '" data-url-update="' . route('channel.episodes.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('channel.episodes.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['show_id', 'season_id', 'poster', 'download', 'subtitles', 'upcoming', 'premium', 'status', 'created_at', 'actions'])
			                 ->make(true);
		}
		
		return view('channel.episodes.index');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request)
	{
		$data = $request->validate([
			'show_id' => ['required'],
			'season_id' => ['required'],
			'title' => ['required'],
			'description' => ['required'],
			'imdb_rating' => ['required'],
			'content_rating' => ['required'],
			'release_date' => ['required'],
			'poster' => ['required'],
			'trailer' => ['required'],
			'videos.1080p' => ['required'],
			'videos.720p' => ['required'],
			'videos.480p' => ['required'],
			'videos.360p' => ['required'],
			'subtitles_data.*' => ['required'],
			'meta_title' => ['sometimes'],
			'meta_description' => ['sometimes'],
			'meta_keywords' => ['sometimes'],
			'download' => ['sometimes'],
			'subtitles' => ['sometimes'],
			'upcoming' => ['sometimes'],
			'premium' => ['sometimes'],
		]);

        $data['channel_id'] = $this->channel->id;

		$episode = Episode::create($data);
		
		// Link poster
		$episode->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link trailer
        $episode->media()->attach([$request->trailer => ['type' => 'trailer']]);

        // Link videos
		foreach ($request->videos as $type => $video) {
			$episode->media()->attach([$video => ['type' => $type]]);
		}
		
		// Link subtitles
		foreach ($request->subtitles_data as $subtitle) {
			$episode->media()->attach([$subtitle => ['type' => 'subtitle']]);
		}
		
		return response()->json([
			'status' => true,
			'message' => 'Successfully created!',
			'data' => $episode,
		]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Episode $episode
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit(Episode $episode)
	{
		return response()->json([
			'status' => true,
			'data' => [
				'episode' => $episode,
				'show' => $episode->show,
				'season' => $episode->season,
				'media' => [
					'poster' => $episode->media()->poster('episode')->first(),
					'trailer' => $episode->media()->trailer('episode')->first(),
					'videos' => $episode->media()->videos('episode')->get(),
					'subtitles' => $episode->media()->subtitles('episode')->get(),
				],
			],
		]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Episode      $episode
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, Episode $episode)
	{
		$data = $request->validate([
			'show_id' => ['required'],
			'season_id' => ['required'],
			'title' => ['required'],
			'description' => ['required'],
			'imdb_rating' => ['required'],
			'content_rating' => ['required'],
			'release_date' => ['required'],
			'poster' => ['required'],
			'trailer' => ['required'],
			'videos.1080p' => ['required'],
			'videos.720p' => ['required'],
			'videos.480p' => ['required'],
			'videos.360p' => ['required'],
			'subtitles_data.*' => ['required'],
			'meta_title' => ['sometimes'],
			'meta_description' => ['sometimes'],
			'meta_keywords' => ['sometimes'],
			'download' => ['sometimes'],
			'subtitles' => ['sometimes'],
			'upcoming' => ['sometimes'],
			'premium' => ['sometimes'],
		]);
		
		$data['download'] = $request->download ?? 0;
		$data['subtitles'] = $request->subtitles ?? 0;
		$data['upcoming'] = $request->upcoming ?? 0;
		$data['premium'] = $request->premium ?? 0;
		
		$episode->update($data);
		
		// Remove all synced media
		$episode->media()->sync([]);
		
		// Link poster
		$episode->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link poster
        $episode->media()->attach([$request->trailer => ['type' => 'trailer']]);

        // Link videos
		foreach ($request->videos as $type => $video) {
			$episode->media()->attach([$video => ['type' => $type]]);
		}
		
		// Link subtitles
		foreach ($request->subtitles_data as $subtitle) {
			$episode->media()->attach([$subtitle => ['type' => 'subtitle']]);
		}
		
		return response()->json([
			'status' => true,
			'message' => 'Successfully updated!',
			'data' => $episode,
		]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Episode $episode
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Episode $episode)
	{
		$episode->delete();
		
		return response()->json([
			'status' => true,
			'message' => 'Successfully deleted!',
		]);
	}
	
	/**
	 * Publish the specified resource from storage.
	 *
	 * @param  \App\Models\Episode $episode
	 * @return \Illuminate\Http\Response
	 */
	public function publish(Episode $episode)
	{
		$episode->update([
			'status' => 1,
		]);
		
		return response([
			'status' => true,
			'message' => 'Successfully updated!',
		]);
	}
	
	/**
	 * Unpublish the specified resource from storage.
	 *
	 * @param  \App\Models\Episode $episode
	 * @return \Illuminate\Http\Response
	 */
	public function unpublish(Episode $episode)
	{
		$episode->update([
			'status' => 0,
		]);
		
		return response([
			'status' => true,
			'message' => 'Successfully updated!',
		]);
	}
}
