<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    protected $channel;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->channel = Auth::user()->channels()->first();
            // $this->channel = Auth::user()->user()->first();

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        // dd(Auth::user());
        // $genres = $this->channel->genres()->where('parent_id', NULL)->orderBy('order')->with('children')->get();
        $genres = Genre::latest()->get();
        return view('channel.genres.index', ['genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['sometimes'],
            'thumbnail' => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        $thumbnail = Storage::disk('public')->putFile('thumbnails/genres', $request->thumbnail);

        $genre = Genre::create([
            'channel_id' => '1',
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'thumbnail' => $thumbnail,
        ]);

        return response([
            'status' => true,
            'message' => 'Successfully created!',
            'data' => $genre,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $genre = Genre::find($id);

        if ($genre) {
            return response([
                'status' => true,
                'data' => $genre,
            ]);
        }

        return response([
            'status' => false,
            'message' => 'Record not found!',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Genre $genre
     * @return Response
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['sometimes'],
        ]);

        // If thumbnail exists
        if ($request->has('thumbnail')) {
            Storage::disk('public')->delete($genre->thumbnail);
            $thumbnail = Storage::disk('public')->putFile('thumbnails/genres', $request->thumbnail);
        }

        // Update genre
        $genre->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'thumbnail' => $thumbnail ?? $genre->thumbnail,
        ]);

        // Return Response
        return response([
            'status' => true,
            'message' => 'Successfully updated!',
            'data' => $genre,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Genre $genre)
    {
        Storage::disk('public')->delete($genre->thumbnail);

        // Find all record and remove their parent_id
        Genre::where('parent_id', $genre->id)->update([
            'parent_id' => Null,
        ]);

        $genre->delete();

        $genres = $this->channel->genres()->where('parent_id', NULL)->orderBy('order')->with('children')->get();
        $view = view('admin.genres.partials.genres', compact('genres'))->render();

        return response([
            'status' => true,
            'message' => 'Successfully deleted!',
            'data' => $view,
        ]);
    }

    /**
     * Update the specified resource order in storage.
     *
     * @param Request $request
     * @return void
     */
    public function reorder(Request $request)
    {
        // Using transaction here, to perform multiple queries in a single query
        // To improve performance
        DB::beginTransaction();
        foreach ($request->genres as $genre) {
            $genre = (object)$genre;
            DB::table('genres')->where('id', $genre->id)->update([
                'parent_id' => $genre->parent_id,
                'order' => $genre->order,
            ]);
        }
        DB::commit();
    }
}
