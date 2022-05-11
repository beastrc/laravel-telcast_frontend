<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Live;
use App\Models\Movie;
use App\Models\Season;
use App\Models\Show;
use App\Models\Sport;
use App\Models\Spotlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SpotlightController extends Controller
{
    protected $channel;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->channel = Auth::user()->channels()->first();

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $instance = $this->channel->spotlights()->latest()->with('spotlightable');
            $instance = Spotlight::latest()->get();

            return DataTables::of($instance)
                ->addIndexColumn()
                ->addColumn('poster', function ($row) {
                    $media = $row->spotlightable->media()->poster('movie')->first();

                    if (!empty($media)) {
                        return '<img src="' . asset('storage/' . $media->path) . '" class="img-fluid img-thumbnail">';
                    }

                    return 'Undefined';
                })
                ->addColumn('title', function ($row) {
                    return $row->spotlightable->title;
                })
                ->addColumn('type', function ($row) {
                    return getModelName($row->spotlightable);
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    return
                        '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url="' . route('channel.spotlights.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
									    </div>
									</div>';
                })
                ->rawColumns(['poster', 'title', 'type', 'created_at', 'actions'])
                ->make(true);
        }

        return view('channel.spotlights.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'genre' => ['required'],
            'segment' => ['required'],
            'spotlight' => ['required'],
        ]);

        switch ($request->segment) {
            case 'movie':
                $data = ['spotlightable_type' => Movie::class];
                break;

            case 'show':
                $data = ['spotlightable_type' => Show::class];
                break;

            case 'season':
                $data = ['spotlightable_type' => Season::class];
                break;

            case 'episode':
                $data = ['spotlightable_type' => Episode::class];
                break;

            case 'live':
                $data = ['spotlightable_type' => Live::class];
                break;

            case 'sport':
                $data = ['spotlightable_type' => Sport::class];
                break;
        }

        $data['spotlightable_id'] = $request->spotlight;

        $this->channel->spotlights()->create($data);

        return response()->json([
            'status' => true,
            'message' => 'Successfully created!',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Spotlight $spotlight
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Spotlight $spotlight)
    {
        $spotlight->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully deleted!',
        ]);
    }
}
