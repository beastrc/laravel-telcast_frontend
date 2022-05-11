<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Like;
use App\Models\Live;
use App\Models\Movie;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'resource' => ['required']
        ]);

        switch ($request->resource){
            case 'movie':
                $resource = Movie::findOrFail($request->id);
                $relation = Auth::user()->likedMovies();
                break;

            case 'episode':
                $resource = Episode::findOrFail($request->id);
                $relation = Auth::user()->likedEpisodes();
                break;

            case 'live':
                $resource = Live::findOrFail($request->id);
                $relation = Auth::user()->likedLives();
                break;

            case 'sport':
                $resource = Sport::findOrFail($request->id);
                $relation = Auth::user()->likedSports();
                break;
        }

        $likeable = $relation->where('likeable_id', $resource->id);

        switch ($likeable->exists()) {
            case true:
                switch ($likeable->first()->pivot->liked) {
                    case 1:
                        $likeable->detach();
                        break;

                    default:
                        $likeable->update([
                            'liked' => 1,
                            'disliked' => null,
                        ]);
                        break;
                }
                break;

            default:
                Like::create([
                    'user_id' => Auth::id(),
                    'likeable_id' => $resource->id,
                    'likeable_type' => get_class($resource),
                    'liked' => 1,
                ]);
                break;
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated!',
            'data' => [
                'likes' => $resource->likes()->where('disliked', null)->count(),
                'dislikes' => $resource->likes()->where('liked', null)->count(),
            ]
        ]);
    }

    public function dislike(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'resource' => ['required']
        ]);

        switch ($request->resource){
            case 'movie':
                $resource = Movie::findOrFail($request->id);
                $relation = Auth::user()->likedMovies();
                break;

            case 'episode':
                $resource = Episode::findOrFail($request->id);
                $relation = Auth::user()->likedEpisodes();
                break;

            case 'live':
                $resource = Live::findOrFail($request->id);
                $relation = Auth::user()->likedLives();
                break;

            case 'sport':
                $resource = Sport::findOrFail($request->id);
                $relation = Auth::user()->likedSports();
                break;
        }

        $likeable = $relation->where('likeable_id', $resource->id);

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
                    'likeable_id' => $resource->id,
                    'likeable_type' => get_class($resource),
                    'disliked' => 1,
                ]);
                break;
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated!',
            'data' => [
                'likes' => $resource->likes()->where('disliked', null)->count(),
                'dislikes' => $resource->likes()->where('liked', null)->count(),
            ]
        ]);
    }
}
