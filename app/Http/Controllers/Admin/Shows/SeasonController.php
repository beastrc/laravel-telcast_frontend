<?php

namespace App\Http\Controllers\Admin\Shows;

use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SeasonController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$instance = Season::latest();
			return DataTables::of($instance)
			                 ->addIndexColumn()
			                 ->addColumn('show', function ($row) {
				                 return $row->show->title ?? 'Undefined';
			                 })
			                 ->addColumn('description', function ($row) {
				                 return Str::limit($row->description, 50);
			                 })
			                 ->addColumn('poster', function ($row) {
				                 $media = $row->media()->poster('season')->first();
				
				                 if (!empty($media)) {
					                 return '<img src="' . asset('storage/' . $media->path) . '" class="img-fluid img-thumbnail">';
				                 }
				
				                 return 'Undefined';
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
					                 '<a href="#!" data-url="' . route('admin.seasons.unpublish', $row->id) . '" class="btn-toggle dropdown-item">Unpublish</a>' :
					                 '<a href="#!" data-url="' . route('admin.seasons.publish', $row->id) . '" class="btn-toggle dropdown-item">Publish</a>';
				
				                 return
					                 '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('admin.seasons.edit', $row->id) . '" data-url-update="' . route('admin.seasons.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('admin.seasons.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['poster', 'status', 'created_at', 'actions'])
			                 ->make(true);
		}
		
		return view('admin.seasons.index');
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
			'title' => ['required'],
			'description' => ['required'],
			'poster' => ['required'],
			'trailer' => ['required'],
			'meta_title' => ['sometimes'],
			'meta_description' => ['sometimes'],
			'meta_keywords' => ['sometimes'],
		]);
		
		$season = Season::create($data);
		
		// Link poster
		$season->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link trailer
        $season->media()->attach([$request->trailer => ['type' => 'trailer']]);

        return response()->json([
			'status' => true,
			'message' => 'Successfully created!',
			'data' => $season,
		]);
	}
	
	/**
	 * Season the form for editing the specified resource.
	 *
	 * @param  \App\Models\Season $season
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit(Season $season)
	{
		return response()->json([
			'status' => true,
			'data' => [
				'season' => $season,
				'show' => $season->show,
				'media' => [
					'poster' => $season->media()->poster('season')->first(),
					'trailer' => $season->media()->trailer('season')->first(),
				],
			],
		]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Season       $season
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, Season $season)
	{
		$data = $request->validate([
			'show_id' => ['required'],
			'title' => ['required'],
			'description' => ['required'],
			'poster' => ['required'],
			'trailer' => ['required'],
			'meta_title' => ['sometimes'],
			'meta_description' => ['sometimes'],
			'meta_keywords' => ['sometimes'],
		]);
		
		$season->update($data);

        // Remove all synced media
        $season->media()->sync([]);

        // Link poster
        $season->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link trailer
        $season->media()->attach([$request->trailer => ['type' => 'trailer']]);

		return response()->json([
			'status' => true,
			'message' => 'Successfully updated!',
			'data' => $season,
		]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Season $season
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Season $season)
	{
		$season->delete();
		
		return response()->json([
			'status' => true,
			'message' => 'Successfully deleted!',
		]);
	}
	
	/**
	 * Publish the specified resource from storage.
	 *
	 * @param  \App\Models\Season $season
	 * @return \Illuminate\Http\Response
	 */
	public function publish(Season $season)
	{
		$season->update([
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
	 * @param  \App\Models\Season $season
	 * @return \Illuminate\Http\Response
	 */
	public function unpublish(Season $season)
	{
		$season->update([
			'status' => 0,
		]);
		
		return response([
			'status' => true,
			'message' => 'Successfully updated!',
		]);
	}
}
