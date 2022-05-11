<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $instance = Sport::latest();
            return DataTables::of($instance)
                ->addIndexColumn()
                ->addColumn('poster', function ($row) {
                    $media = $row->media()->poster('sport')->first();

                    if (!empty($media)) {
                        return '<img src="' . asset('storage/' . $media->path) . '" class="img-fluid img-thumbnail">';
                    }

                    return 'Undefined';
                })
                ->editColumn('description', function ($row) {
                    return Str::limit($row->description, 50);
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
                        '<a href="#!" data-url="' . route('admin.sports.unpublish', $row->id) . '" class="btn-toggle dropdown-item">Unpublish</a>' :
                        '<a href="#!" data-url="' . route('admin.sports.publish', $row->id) . '" class="btn-toggle dropdown-item">Publish</a>';

                    return
                        '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('admin.sports.edit', $row->id) . '" data-url-update="' . route('admin.sports.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('admin.sports.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
                })
                ->rawColumns(['poster', 'download', 'subtitles', 'upcoming', 'premium', 'status', 'created_at', 'actions'])
                ->make(true);
        }

        return view('admin.sports.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'genres' => ['required'],
            'languages' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
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

        $sport = Sport::create($data);

        // Link genres & languages
        $sport->genres()->sync($request->input('genres'));
        $sport->languages()->sync($request->input('languages'));

        // Link poster
        $sport->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link trailer
        $sport->media()->attach([$request->trailer => ['type' => 'trailer']]);

        // Link videos
        foreach ($request->videos as $type => $video) {
            $sport->media()->attach([$video => ['type' => $type]]);
        }

        // Link subtitles
        foreach ($request->subtitles_data as $subtitle) {
            $sport->media()->attach([$subtitle => ['type' => 'subtitle']]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully created!',
            'data' => $sport,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sport $sport
     * @return JsonResponse
     */
    public function edit(Sport $sport)
    {
        return response()->json([
            'status' => true,
            'data' => [
                'sport' => $sport,
                'genres' => $sport->genres,
                'languages' => $sport->languages,
                'media' => [
                    'poster' => $sport->media()->poster('sport')->first(),
                    'trailer' => $sport->media()->trailer('sport')->first(),
                    'videos' => $sport->media()->videos('sport')->get(),
                    'subtitles' => $sport->media()->subtitles('sport')->get(),
                ],
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Sport $sport
     * @return JsonResponse
     */
    public function update(Request $request, Sport $sport)
    {
        $data = $request->validate([
            'genres' => ['required'],
            'languages' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
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

        $sport->update($data);

        // Link genres & languages
        $sport->genres()->sync($request->input('genres'));
        $sport->languages()->sync($request->input('languages'));

        // Remove all synced media
        $sport->media()->sync([]);

        // Link poster
        $sport->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link poster
        $sport->media()->attach([$request->trailer => ['type' => 'trailer']]);

        // Link videos
        foreach ($request->videos as $type => $video) {
            $sport->media()->attach([$video => ['type' => $type]]);
        }

        // Link subtitles
        foreach ($request->subtitles_data as $subtitle) {
            $sport->media()->attach([$subtitle => ['type' => 'subtitle']]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated!',
            'data' => $sport,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sport $sport
     * @return JsonResponse
     */
    public function destroy(Sport $sport)
    {
        $sport->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully deleted!',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param Sport $sport
     * @return Response
     */
    public function publish(Sport $sport)
    {
        $sport->update([
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
     * @param Sport $sport
     * @return Response
     */
    public function unpublish(Sport $sport)
    {
        $sport->update([
            'status' => 0,
        ]);

        return response([
            'status' => true,
            'message' => 'Successfully updated!',
        ]);
    }
}
