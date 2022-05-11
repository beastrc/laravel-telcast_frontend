<?php

namespace App\Http\Controllers\Admin\Shows;

use App\Http\Controllers\Controller;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ShowController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$instance = Show::latest();
			return DataTables::of($instance)
			                 ->addIndexColumn()
			                 ->editColumn('actors', function ($row) {
				                 $actors = '';
				
				                 foreach ($row->actors as $actor) {
					                 $actors .= '<span class="badge badge-sm badge-success">' . $actor . '</span>';
				                 }
				
				                 return $actors;
			                 })
			                 ->editColumn('directors', function ($row) {
				                 $directors = '';
				
				                 foreach ($row->directors as $director) {
					                 $directors .= '<span class="badge badge-sm badge-success">' . $director . '</span>';
				                 }
				
				                 return $directors;
			                 })
			                 ->addColumn('poster', function ($row) {
				                 $media = $row->media()->poster('show')->first();
				                 
				                 if (!empty($media)) {
					                 return '<img src="' . asset('storage/' . $media->path) . '" class="img-fluid img-thumbnail">';
				                 }
				
				                 return 'Undefined';
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
					                 '<a href="#!" data-url="' . route('admin.shows.unpublish', $row->id) . '" class="btn-toggle dropdown-item">Unpublish</a>' :
					                 '<a href="#!" data-url="' . route('admin.shows.publish', $row->id) . '" class="btn-toggle dropdown-item">Publish</a>';
				
				                 return
					                 '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('admin.shows.edit', $row->id) . '" data-url-update="' . route('admin.shows.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('admin.shows.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['actors', 'directors', 'poster', 'upcoming', 'premium', 'status', 'created_at', 'actions'])
			                 ->make(true);
		}
		
		return view('admin.shows.index');
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
			'genres' => ['required'],
			'languages' => ['required'],
			'title' => ['required'],
			'description' => ['required'],
			'actors' => ['sometimes'],
			'directors' => ['sometimes'],
			'imdb_rating' => ['required'],
			'content_rating' => ['required'],
			'poster' => ['required'],
			'trailer' => ['required'],
			'meta_title' => ['sometimes'],
			'meta_description' => ['sometimes'],
			'meta_keywords' => ['sometimes'],
			'upcoming' => ['sometimes'],
			'premium' => ['sometimes'],
		]);
		
		$show = Show::create($data);
		
		$show->genres()->sync($request->input('genres'));
		$show->languages()->sync($request->input('languages'));
		
		// Link poster
		$show->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link trailer
        $show->media()->attach([$request->trailer => ['type' => 'trailer']]);

        return response()->json([
			'status' => true,
			'message' => 'Successfully created!',
			'data' => $show,
		]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Show $show
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit(Show $show)
	{
		return response()->json([
			'status' => true,
			'data' => [
				'show' => $show,
				'genres' => $show->genres,
				'languages' => $show->languages,
				'media' => [
					'poster' => $show->media()->poster('show')->first(),
                    'trailer' => $show->media()->trailer('show')->first(),
                ],
			]
		]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Show         $show
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, Show $show)
	{
		$data = $request->validate([
			'genres' => ['required'],
			'languages' => ['required'],
			'title' => ['required'],
			'description' => ['required'],
			'actors' => ['sometimes'],
			'directors' => ['sometimes'],
			'imdb_rating' => ['required'],
			'content_rating' => ['required'],
			'poster' => ['sometimes'],
			'trailer' => ['sometimes'],
			'meta_title' => ['sometimes'],
			'meta_description' => ['sometimes'],
			'meta_keywords' => ['sometimes'],
			'upcoming' => ['sometimes'],
			'premium' => ['sometimes'],
		]);
		
		$data['upcoming'] = $request->upcoming ?? 0;
		$data['premium'] = $request->premium ?? 0;
		
		$show->update($data);
		
		$show->genres()->sync($request->input('genres'));
		$show->languages()->sync($request->input('languages'));

        // Remove all synced media
        $show->media()->sync([]);

        // Link poster
        $show->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link trailer
        $show->media()->attach([$request->trailer => ['type' => 'trailer']]);

		return response()->json([
			'status' => true,
			'message' => 'Successfully updated!',
			'data' => $show,
		]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Show $show
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Show $show)
	{
		$show->delete();
		
		return response()->json([
			'status' => true,
			'message' => 'Successfully deleted!',
		]);
	}
	
	/**
	 * Publish the specified resource from storage.
	 *
	 * @param  \App\Models\Show $show
	 * @return \Illuminate\Http\Response
	 */
	public function publish(Show $show)
	{
		$show->update([
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
	 * @param  \App\Models\Show $show
	 * @return \Illuminate\Http\Response
	 */
	public function unpublish(Show $show)
	{
		$show->update([
			'status' => 0,
		]);
		
		return response([
			'status' => true,
			'message' => 'Successfully updated!',
		]);
	}
}
