<?php

namespace App\Http\Controllers\Channel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionAnalyticController extends Controller
{
    protected $channel;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->channel = Auth::user()->channels()->first();

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('channel.subscription-analytics.index', [
            'channel' => $this->channel
        ]);
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
            'subscription_price_without_ads' => ['required'],
            'subscription_price_with_ads' => ['required'],
        ]);

        $this->channel->update([
            'subscription_price_without_ads' => $request->input('subscription_price_without_ads'),
            'subscription_price_with_ads' => $request->input('subscription_price_with_ads'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
}
