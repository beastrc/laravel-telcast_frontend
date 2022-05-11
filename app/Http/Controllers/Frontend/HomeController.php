<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Like;
use App\Models\Live;
use App\Models\Movie;
use App\Models\MyList;
use App\Models\Show;
use App\Models\Visit;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        switch (Auth::check() && Auth::user()->role === 'user') {
            case true:
                if (Auth::check() || Session::has('guest')) {
                    $watches = Watch::where('user_id', Auth::id() ?? Session::get('guest')['id'])
                        ->with('watchable')
                        ->groupBy(['watchable_id', 'watchable_type'])
                        ->orderByRaw('SUM(watch_time) DESC')
                        ->latest('updated_at')
                        ->limit(20)->get();

                    $board = MyList::where('user_id', Auth::id() ?? Session::get('guest')['id'])
                        ->with('myListable')
                        ->groupBy(['my_listable_id', 'my_listable_type'])
                        ->latest('updated_at')
                        ->limit(20)->get();

                    $histories = Visit::where('user_id', Auth::id() ?? Session::get('guest')['id'])
                        ->with('visitable')
                        ->groupBy(['visitable_id', 'visitable_type'])
                        ->orderByRaw('SUM(visits) DESC')
                        ->latest('updated_at')
                        ->limit(20)->get();
                }

//                $recommended = Visit::with(['visitable'])
//                    ->groupBy(['visitable_id', 'visitable_type', 'likeable_id', 'likeable_type'])
//                    ->join('likes', 'likes.likeable_id', '=', 'visits.visitable_id')
//                    ->orderByRaw('SUM(likes.liked) DESC')
////                    ->orderByRaw('SUM(visits.visits) DESC')
//                    ->limit(20)->get();

                $recommended = Like::with(['likeable'])
                    ->groupBy(['likeable_id', 'likeable_type'])
                    ->orderByRaw('SUM(likes.liked) DESC')
                    ->limit(20)->get();

                $trending = Visit::with('visitable')
                    ->groupBy(['visitable_id', 'visitable_type'])
                    ->orderByRaw('SUM(visits) DESC')
                    ->limit(20)->get();

                $channels = Channel::latest()->limit(20)->get();
                $lives = Live::latest()->limit(20)->get();
                $shows = Show::latest()->limit(20)->get();
                $movies = Movie::latest()->limit(20)->get();

                return view('frontend.home', [
                    'watches' => $watches ?? null,
                    'board' => $board ?? null,
                    'histories' => $histories ?? null,
                    'recommended' => $recommended->pluck('likeable'),
                    'trending' => $trending,
                    'channels' => $channels,
                    'lives' => $lives,
                    'shows' => $shows,
                    'movies' => $movies,
                ]);

            default:
                return view('frontend.welcome');
        }
    }
//begin :: beast test
    public function testhome()
    {
        return view('frontend.welcome');
    }
//begin :: beast end
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
