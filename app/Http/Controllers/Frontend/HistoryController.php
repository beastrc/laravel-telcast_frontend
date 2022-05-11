<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check() || Session::has('guest')) {
            $history = Visit::where('user_id', Auth::id() ?? Session::get('guest')['id'])
                ->whereHasMorph('visitable', '*', function ($query) use ($request) {
                    if ($request->has('keywords')) {
                        $query->where('title', 'LIKE', '%' . $request->keywords . '%');
                    }
                })
                ->with('visitable')
                ->whereNotIn('visitable_type', ['App\Models\Channel'])
                ->groupBy(['visitable_id', 'visitable_type'])
                ->orderByRaw('SUM(visits) DESC')
                ->latest('updated_at')
                ->paginate(40)
                ->withQueryString();
        }

        return view('frontend.history.index', [
            'history' => $history ?? null
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
