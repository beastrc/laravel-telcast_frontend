<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        $genres = Genre::with(['movies' => function($q) use($request){
            if($request->has('keywords')){
                $q->where('title', 'LIKE', '%'.$request->keywords.'%');
            }

            $q->latest()->limit(20);
        }])->latest()->paginate(50);

        return view('frontend.movies.index', [
            'genres' => $genres
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return Application|Factory|View|Response
     */
    public function show(Movie $movie)
    {
        $views = $movie->visits()->sum('visits');
        $likes = $movie->likes()->where('disliked', null)->count();
        $dislikes = $movie->likes()->where('liked', null)->count();
        $comments = $movie->comments()->with('replies')->latest()->paginate(20);

        return view('frontend.video', [
            'video' => $movie,
            'views' => $views,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function genres(Genre $genre, Request $request)
    {
        switch ($request->has('keywords')){
            case true:
                $movies = $genre->movies()
                    ->where('title', 'LIKE', '%'.$request->keywords.'%')
                    ->latest('created_at')->paginate(50);
                break;

            default:
                $movies = $genre->movies()->latest('created_at')->paginate(50);
                break;
        }

        return view('frontend.movies.genres', [
            'genre' => $genre,
            'movies' => $movies
        ]);
    }
}
