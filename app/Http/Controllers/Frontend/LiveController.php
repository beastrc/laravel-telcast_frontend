<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Live;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Live $live)
    {
        $views = $live->visits()
            ->latest('created_at')
            ->groupBy('visitable_id')
            ->sum('visits');

        $likeables = $live->likes;
        $likes = $likeables->where('disliked', null)->count();
        $dislikes = $likeables->where('liked', null)->count();
        $comments = $live->comments()->with('replies')->latest()->paginate(20);

        return view('frontend.live.show', [
            'live' => $live,
            'views' => $views,
            'likes' => $likes,
            'dislikes' => $dislikes,
            'comments' => $comments
        ]);
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

    public function like(Request $request)
    {
    }

    public function dislike(Request $request)
    {
        $request->validate([
            'id' => ['required']
        ]);

        $live = Live::findOrFail($request->id);

        $likeable = Auth::user()->likedLives()->where('likeable_id', $live->id);

        switch ($likeable->exists()) {
            case true:
                switch ($likeable->first()->pivot->disliked) {
                    case 1:
                        $likeable->detach();
                        break;

                    default:
                        $likeable->update([
                            'liked' => null,
                            'disliked' => 1,
                        ]);
                        break;
                }
                break;

            default:
                Like::create([
                    'user_id' => Auth::id(),
                    'likeable_id' => $live->id,
                    'likeable_type' => get_class($live),
                    'disliked' => 1,
                ]);
                break;
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully completed!',
            'data' => [
                'likes' => $live->likes()->where('disliked', null)->count(),
                'dislikes' => $live->likes()->where('liked', null)->count(),
            ]
        ]);
    }
}
