<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $genres = Genre::with(['shows' => function($q) use($request){
            if($request->has('keywords')){
                $q->where('title', 'LIKE', '%'.$request->keywords.'%');
            }

            $q->latest()->limit(20);
        }])->latest()->paginate(50);

        return view('frontend.shows.index', [
            'genres' => $genres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show)
    {
        return view('frontend.shows.show', compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function genres(Genre $genre, Request $request)
    {
        switch ($request->has('keywords')){
            case true:
                $shows = $genre->shows()
                    ->where('title', 'LIKE', '%'.$request->keywords.'%')
                    ->latest('created_at')->paginate(50);
                break;

            default:
                $shows = $genre->shows()->latest('created_at')->paginate(50);
                break;
        }

        return view('frontend.shows.genres', [
            'genre' => $genre,
            'shows' => $shows
        ]);
    }
}
