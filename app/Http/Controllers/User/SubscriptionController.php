<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            switch ($request->has('type') && $request->type === 'channels') {
                case false:
                    $instance = Auth::user()->mySubscriptions()->latest();
                    return DataTables::of($instance)
                        ->addIndexColumn()
                        ->addColumn('channel', function ($row) {
                            $channel = $row->channel;
                            return '<img src="' . asset("storage/{$channel->logo}") . '" class="img-fluid img-thumbnail mr-1">' . $channel->title;
                        })
                        ->editColumn('status', function ($row) {
                            switch ($row->status === 1) {
                                case true:
                                    return '<span class="badge badge-sm badge-success">Paid</span>';

                                default:
                                    return '<span class="badge badge-sm badge-warning">Unpaid</span>';
                            }
                        })
                        ->editColumn('created_at', function ($row) {
                            return $row->created_at->diffForHumans();
                        })
                        ->addColumn('actions', function ($row) {
                            return
                                '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
									    </div>
									</div>';
                        })
                        ->rawColumns(['channel', 'status', 'created_at', 'actions'])
                        ->make(true);

                case true:
                    $instance = Channel::latest();
                    return DataTables::of($instance)
                        ->addIndexColumn()
                        ->addColumn('channel', function ($row) {
                            return '<img src="' . asset("storage/{$row->logo}") . '" class="img-fluid img-thumbnail mr-1">' . $row->title;
                        })
                        ->editColumn('subscription_price_without_ads', function ($row) {
                            return '$'.$row->subscription_price_without_ads;
                        })
                        ->editColumn('subscription_price_with_ads', function ($row) {
                            return '$'.$row->subscription_price_with_ads;
                        })
                        ->addColumn('actions', function ($row) {
                            return
                                '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
									    </div>
									</div>';
                        })
                        ->rawColumns(['channel', 'actions'])
                        ->make(true);
            }
        }

        return view('user.subscriptions.index');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
