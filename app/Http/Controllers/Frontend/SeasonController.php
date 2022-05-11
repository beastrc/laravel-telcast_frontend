<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Show;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function index(Show $show)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function create(Show $show)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Show $show)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Show  $show
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show, Season $season)
    {
        return view('frontend.seasons.show', compact('show', 'season'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Show  $show
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit(Show $show, Season $season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Show  $show
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Show $show, Season $season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Show  $show
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show, Season $season)
    {
        //
    }
}
