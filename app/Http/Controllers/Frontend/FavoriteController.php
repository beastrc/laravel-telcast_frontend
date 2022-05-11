<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\MyList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'type' => ['required'],
        ]);

        $favorite = Favorite::where('user_id', Auth::id())
            ->where('favoriteable_id', $request->id)
            ->where('favoriteable_type', urldecode($request->type))
            ->latest()
            ->first();

        switch (isset($favorite) && !empty($favorite)){
            case true:
                $favorite->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Successfully removed!'
                ]);

            default:
                Favorite::create([
                    'user_id' => Auth::id(),
                    'favoriteable_id' => $request->id,
                    'favoriteable_type' => urldecode($request->type)
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Successfully added!'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Favorite $favorite)
    {
        $favorite->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully deleted!'
        ]);
    }
}
