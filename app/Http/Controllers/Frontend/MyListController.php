<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\MyList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class MyListController extends Controller
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

        $myList = MyList::where('user_id', Auth::id())
            ->where('my_listable_id', $request->id)
            ->where('my_listable_type', urldecode($request->type))
            ->latest()
            ->first();

        switch (isset($myList) && !empty($myList)){
            case true:
                $myList->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Successfully removed!'
                ]);

            default:
                MyList::create([
                    'user_id' => Auth::id(),
                    'my_listable_id' => $request->id,
                    'my_listable_type' => urldecode($request->type)
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
     * @param  \App\Models\MyList  $myList
     * @return \Illuminate\Http\Response
     */
    public function show(MyList $myList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyList  $myList
     * @return \Illuminate\Http\Response
     */
    public function edit(MyList $myList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyList  $myList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyList $myList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyList  $myList
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(MyList $myList)
    {
        $myList->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully deleted!'
        ]);
    }
}
