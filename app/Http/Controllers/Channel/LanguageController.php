<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class LanguageController extends Controller
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
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			// $instance = $this->channel->languages()->latest();
			$instance = Language::latest();
			return DataTables::of($instance)
			                 ->addIndexColumn()
			                 ->editColumn('thumbnail', function ($row) {
				                 return '<img src="' . asset("storage/" . $row->thumbnail) . '" class="img-fluid img-thumbnail">';
			                 })
			                 ->editColumn('status', function ($row) {
				                 switch ($row->status === 1) {
					                 case true:
						                 return '<span class="badge badge-sm badge-success">Enabled</span>';
					
					                 default:
						                 return '<span class="badge badge-sm badge-warning">Disabled</span>';
				                 }
			                 })
			                 ->editColumn('created_at', function ($row) {
				                 return $row->created_at->diffForHumans();
			                 })
			                 ->addColumn('actions', function ($row) {
				                 $status = $row->status === 1 ?
					                 '<a href="#!" data-url="' . route('channel.languages.disable', $row->id) . '" class="btn-toggle dropdown-item">Disable</a>' :
					                 '<a href="#!" data-url="' . route('channel.languages.enable', $row->id) . '" class="btn-toggle dropdown-item">Enable</a>';
				
				                 return
				                    '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('channel.languages.edit', $row->id) . '" data-url-update="' . route('channel.languages.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('channel.languages.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['thumbnail', 'status', 'created_at', 'actions'])
			                 ->make(true);
		}
		
		return view('channel.languages.index');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data = $request->validate([
			'title' => ['required'],
			'description' => ['required'],
			'thumbnail' => ['required', 'image', 'mimes:png,jpeg,jpg,svg'],
		]);

        $data['channel_id'] = $this->channel->id;
		$data['thumbnail'] = Storage::disk('public')->putFile('thumbnails/languages', $request->thumbnail);
		
		$modal = Language::create($data);
		
		return response([
			'status' => true,
			'message' => 'Record Successfully created!',
			'data' => $modal
		]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Language $language
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Language $language)
	{
		return response([
			'status' => true,
			'data' => $language
		]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Language     $language
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Language $language)
	{
		$data = $request->validate([
			'title' => ['required'],
			'description' => ['required'],
			'thumbnail' => ['bail', 'sometimes', 'mimes:png,jpeg,jpg,svg'],
		]);

		if($request->has('thumbnail')){
			Storage::disk('public')->delete($language->thumbnail);
			$data['thumbnail'] = Storage::disk('public')->putFile('thumbnails/languages', $request->thumbnail);
		}
		
		$language->update($data);
		
		return response([
			'status' => true,
			'message' => 'Record Successfully updated!',
			'data' => $language
		]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Language $language
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Language $language)
	{
		Storage::disk('public')->delete($language->thumbnail);
		
		$language->delete();
		
		return response([
			'status' => true,
			'message' => 'Successfully deleted!'
		]);
	}
	
	/**
	 * Enable the specified resource from storage.
	 *
	 * @param  \App\Models\Language $language
	 * @return \Illuminate\Http\Response
	 */
	public function enable(Language $language)
	{
		$language->update([
			'status' => 1
		]);
		
		return response([
			'status' => true,
			'message' => 'Successfully updated!'
		]);
	}
	
	/**
	 * Disable the specified resource from storage.
	 *
	 * @param  \App\Models\Language $language
	 * @return \Illuminate\Http\Response
	 */
	public function disable(Language $language)
	{
		$language->update([
			'status' => 0
		]);
		
		return response([
			'status' => true,
			'message' => 'Successfully updated!'
		]);
	}
}
