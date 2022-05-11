<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Show;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function index(Show $show, Season $season)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function create(Show $show, Season $season)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Show $show, Season $season)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Season  $season
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show, Season $season, Episode $episode)
    {
	    return view('frontend.episodes.show', compact('season', 'episode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Season  $season
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Show $show, Season $season, Episode $episode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Season  $season
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Show $show, Season $season, Episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Season  $season
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show, Season $season, Episode $episode)
    {
        //
    }
}
