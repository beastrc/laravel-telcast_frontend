<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check() || Session::has('guest')) {
            $watches = Watch::where('user_id', Auth::id() ?? Session::get('guest')['id'])
                ->whereHasMorph('watchable', '*', function ($query) use ($request) {
                    if ($request->has('keywords')) {
                        $query->where('title', 'LIKE', '%' . $request->keywords . '%');
                    }
                })
                ->with('watchable')
                ->groupBy(['watchable_id', 'watchable_type'])
                ->orderByRaw('SUM(watch_time) DESC')
                ->latest('updated_at')
                ->paginate(40)
                ->withQueryString();
        }

        return view('frontend.watches.index', [
            'watches' => $watches ?? null
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
        $request->validate([
            'watchable_id' => ['required'],
            'watchable_type' => ['required'],
            'current_time' => ['required'],
        ]);

        $user = Auth::check() ? Auth::user() : Session::get('guest');

        Watch::updateOrCreate(
            [
                'user_id' => $user->id,
                'watchable_id' => $request->watchable_id,
                'watchable_type' => urldecode($request->watchable_type),
                'ip_address' => $request->ip(),
            ],
            [
                'watchable_id' => $request->watchable_id,
                'watchable_type' => urldecode($request->watchable_type),
                'current_time' => $request->current_time,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]
        );
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
