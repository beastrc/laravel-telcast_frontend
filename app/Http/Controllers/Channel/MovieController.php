<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MovieController extends Controller
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
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			// $instance = $this->channel->movies()->latest();
			$instance = Movie::latest()->get();
			return DataTables::of($instance)
			                 ->addIndexColumn()
                            ->addColumn('poster', function ($row) {
                                $media = $row->media()->poster('movie')->first();

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
					                 '<a href="#!" data-url="' . route('channel.movies.unpublish', $row->id) . '" class="btn-toggle dropdown-item">Unpublish</a>' :
					                 '<a href="#!" data-url="' . route('channel.movies.publish', $row->id) . '" class="btn-toggle dropdown-item">Publish</a>';

				                 return
					                 '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('channel.movies.edit', $row->id) . '" data-url-update="' . route('channel.movies.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('channel.movies.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['actors', 'directors', 'poster', 'download', 'subtitles', 'upcoming', 'premium', 'status', 'created_at', 'actions'])
			                 ->make(true);
		}

		return view('channel.movies.index');
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
			'actors' => ['required'],
			'directors' => ['required'],
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

		$movie = Movie::create($data);

		$movie->genres()->sync($request->input('genres'));
		$movie->languages()->sync($request->input('languages'));

		// Link poster
		$movie->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link trailer
        $movie->media()->attach([$request->trailer => ['type' => 'trailer']]);

        // Link videos
		foreach ($request->videos as $type => $video) {
			$movie->media()->attach([$video => ['type' => $type]]);
		}

		// Link subtitles
		foreach ($request->subtitles_data as $subtitle) {
			$movie->media()->attach([$subtitle => ['type' => 'subtitle']]);
		}

		return response()->json([
			'status' => true,
			'message' => 'Successfully created!',
			'data' => $movie,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Movie $movie
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function edit(Movie $movie)
	{
		return response()->json([
			'status' => true,
			'data' => [
				'movie' => $movie,
				'genres' => $movie->genres,
				'languages' => $movie->languages,
				'media' => [
					'poster' => $movie->media()->poster('movie')->first(),
                    'trailer' => $movie->media()->trailer('movie')->first(),
					'videos' => $movie->media()->videos('movie')->get(),
					'subtitles' => $movie->media()->subtitles('movie')->get(),
				],
			],
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Movie        $movie
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, Movie $movie)
	{
		$data = $request->validate([
			'genres' => ['required'],
			'languages' => ['required'],
			'title' => ['required'],
			'description' => ['required'],
			'actors' => ['required'],
			'directors' => ['required'],
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

		$movie->update($data);

		$movie->genres()->sync($request->input('genres'));
		$movie->languages()->sync($request->input('languages'));

		// Remove all synced media
		$movie->media()->sync([]);

		// Link poster
		$movie->media()->attach([$request->poster => ['type' => 'poster']]);

        // Link trailer
        $movie->media()->attach([$request->trailer => ['type' => 'trailer']]);

        // Link videos
		foreach ($request->videos as $type => $video) {
			$movie->media()->attach([$video => ['type' => $type]]);
		}

		// Link subtitles
		foreach ($request->subtitles_data as $subtitle) {
			$movie->media()->attach([$subtitle => ['type' => 'subtitle']]);
		}

		return response()->json([
			'status' => true,
			'message' => 'Successfully updated!',
			'data' => $movie,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Movie $movie
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Movie $movie)
	{
		$movie->delete();

		return response()->json([
			'status' => true,
			'message' => 'Successfully deleted!',
		]);
	}

	/**
	 * Publish the specified resource from storage.
	 *
	 * @param  \App\Models\Movie $movie
	 * @return \Illuminate\Http\Response
	 */
	public function publish(Movie $movie)
	{
		$movie->update([
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
	 * @param  \App\Models\Movie $movie
	 * @return \Illuminate\Http\Response
	 */
	public function unpublish(Movie $movie)
	{
		$movie->update([
			'status' => 0,
		]);

		return response([
			'status' => true,
			'message' => 'Successfully updated!',
		]);
	}
}
