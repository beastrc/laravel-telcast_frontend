<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Live;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show(Sport $sport)
    {
        $views = $sport->visits()
            ->latest('created_at')
            ->groupBy('visitable_id')
            ->sum('visits');

        $likeables = $sport->likes;
        $likes = $likeables->where('disliked', null)->count();
        $dislikes = $likeables->where('liked', null)->count();

        return view('frontend.sports.show', [
            'sport' => $sport,
            'views' => $views,
            'likes' => $likes,
            'dislikes' => $dislikes,
        ]);
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

    public function like(Request $request)
    {
        $request->validate([
            'id' => ['required']
        ]);

        $sport = Sport::findOrFail($request->id);

        if(Auth::user()->likedSports()->where('likeable_id', $sport->id)->exists()){
            Auth::user()->likedSports()->where('likeable_id', $sport->id)->update([
                'liked' => 1,
                'disliked' => null,
            ]);
        }
        else{
            Like::create([
                'user_id' => Auth::id(),
                'likeable_id' => $sport->id,
                'likeable_type' => get_class($sport),
                'liked' => 1,
                'disliked' => null,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully liked!',
            'data' => [
                'likes' => $sport->likes()->where('disliked', null)->count(),
                'dislikes' => $sport->likes()->where('liked', null)->count(),
            ]
        ]);
    }

    public function dislike(Request $request)
    {
        $request->validate([
            'id' => ['required']
        ]);

        $sport = Sport::findOrFail($request->id);

        if(Auth::user()->likedSports()->where('likeable_id', $sport->id)->exists()){
            Auth::user()->likedSports()->where('likeable_id', $sport->id)->update([
                'liked' => null,
                'disliked' => 1,
            ]);
        }
        else{
            Like::create([
                'user_id' => Auth::id(),
                'likeable_id' => $sport->id,
                'likeable_type' => get_class($sport),
                'disliked' => 1,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully disliked!',
            'data' => [
                'likes' => $sport->likes()->where('disliked', null)->count(),
                'dislikes' => $sport->likes()->where('liked', null)->count(),
            ]
        ]);
    }
}
