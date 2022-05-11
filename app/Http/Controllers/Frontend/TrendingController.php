<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Live;
use App\Models\Sport;
use App\Models\Visit;
use Illuminate\Http\Request;

class TrendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trending = Visit::whereHasMorph('visitable', '*', function ($query) use ($request) {
            if ($request->has('keywords')) {
                $query->where('title', 'LIKE', '%' . $request->keywords . '%');
            }
        })
            ->with(['visitable', 'visitable.genres'])
            ->whereNotIn('visitable_type', ['App\Models\Channel'])
            ->groupBy(['visitable_id', 'visitable_type'])
            ->orderByRaw('SUM(visits) DESC')
            ->latest('updated_at')
            ->paginate(40)
            ->withQueryString();
//            ->groupBy(function ($visit){
//                return $visit->visitable()->first()->genres()->first()->name;
//            });


        $visitables = $trending->pluck('visitable');

        dd($visitables->pluck('genres'));
//        dd($visitables, $visitables->whereInstanceOf(Live::class)->pluck('id'));
        $genres = Genre::with(['lives' => function ($q) use ($visitables) {
            $q->whereIn('lives.id', $visitables->whereInstanceOf(Live::class)->pluck('id'))->latest();
        }, 'sports' => function ($q) use ($visitables) {
            $q->whereIn('sports.id', $visitables->whereInstanceOf(Sport::class)->pluck('id'));
        }])->groupBy('name')->paginate(40);

//        dd($genres);
        return view('frontend.trending.index', [
            'genres' => $genres
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
    public function show(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);

        $trending = Visit::with('visitable')
            ->whereHasMorph('visitable', '*', function ($query) use ($request, $id) {
                if ($request->has('keywords')) {
                    $query->where('title', 'LIKE', '%' . $request->keywords . '%');
                }

                $query->whereHas('genres', function ($query) use ($id) {
                    return $query->where('genres.id', $id);
                });
            })
            ->whereNotIn('visitable_type', ['App\Models\Channel'])
            ->groupBy(['visitable_id', 'visitable_type'])
            ->orderByRaw('SUM(visits) DESC')
            ->latest('updated_at')
            ->paginate(40)
            ->withQueryString();

        return view('frontend.trending.show', [
            'genre' => $genre,
            'trending' => $trending
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
}
