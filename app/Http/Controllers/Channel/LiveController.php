<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use App\Models\Live;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class LiveController extends Controller
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
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $instance = $this->channel->lives()->latest();
            $instance = Live::latest();
            return DataTables::of($instance)
                ->addIndexColumn()
                ->addColumn('poster', function ($row) {
                    $media = $row->media()->poster('live')->first();

                    if (!empty($media)) {
                        return '<img src="' . asset('storage/' . $media->path) . '" class="img-fluid img-thumbnail">';
                    }

                    return 'Undefined';
                })
                ->editColumn('description', function ($row) {
                    return Str::limit($row->description, 50);
                })
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
                        '<a href="#!" data-url="' . route('channel.live.unpublish', $row->id) . '" class="btn-toggle dropdown-item">Unpublish</a>' :
                        '<a href="#!" data-url="' . route('channel.live.publish', $row->id) . '" class="btn-toggle dropdown-item">Publish</a>';

                    return
                        '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('channel.live.edit', $row->id) . '" data-url-update="' . route('channel.live.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('channel.live.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
                })
                ->rawColumns(['poster', 'description', 'actors', 'directors', 'upcoming', 'premium', 'status', 'created_at', 'actions'])
                ->make(true);
        }

        return view('channel.live.index');
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
            'actors' => ['required'],
            'directors' => ['required'],
            'content_rating' => ['required'],
            'release_date' => ['required'],
            'poster' => ['required'],
            'type' => ['required'],
            'url' => ['required'],
            'meta_title' => ['sometimes'],
            'meta_description' => ['sometimes'],
            'meta_keywords' => ['sometimes'],
            'upcoming' => ['sometimes'],
            'premium' => ['sometimes'],
        ]);

        $data['channel_id'] = $this->channel->id;

        $live = Live::create($data);

        // Link genres & languages
        $live->genres()->sync($request->input('genres'));
        $live->languages()->sync($request->input('languages'));

        // Link poster
        $live->media()->attach([$request->poster => ['type' => 'poster']]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully created!',
            'data' => $live,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Live $live
     * @return JsonResponse
     */
    public function edit(Live $live)
    {
        return response()->json([
            'status' => true,
            'data' => [
                'live' => $live,
                'genres' => $live->genres,
                'languages' => $live->languages,
                'media' => [
                    'poster' => $live->media()->poster('live')->first(),
                ],
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Live $live
     * @return JsonResponse
     */
    public function update(Request $request, Live $live)
    {
        $data = $request->validate([
            'genres' => ['required'],
            'languages' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'actors' => ['required'],
            'directors' => ['required'],
            'content_rating' => ['required'],
            'release_date' => ['required'],
            'poster' => ['required'],
            'type' => ['required'],
            'url' => ['required'],
            'meta_title' => ['sometimes'],
            'meta_description' => ['sometimes'],
            'meta_keywords' => ['sometimes'],
            'upcoming' => ['sometimes'],
            'premium' => ['sometimes'],
        ]);

        $data['upcoming'] = $request->upcoming ?? 0;
        $data['premium'] = $request->premium ?? 0;

        $live->update($data);

        // Link genres & languages
        $live->genres()->sync($request->input('genres'));
        $live->languages()->sync($request->input('languages'));

        // Remove all synced media
        $live->media()->sync([]);

        // Link poster
        $live->media()->attach([$request->poster => ['type' => 'poster']]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated!',
            'data' => $live,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Live $live
     * @return JsonResponse
     */
    public function destroy(Live $live)
    {
        $live->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully deleted!',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param Live $live
     * @return Response
     */
    public function publish(Live $live)
    {
        $live->update([
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
     * @param Live $live
     * @return Response
     */
    public function unpublish(Live $live)
    {
        $live->update([
            'status' => 0,
        ]);

        return response([
            'status' => true,
            'message' => 'Successfully updated!',
        ]);
    }
}
