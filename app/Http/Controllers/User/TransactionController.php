<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$instance = Auth::user()->transactions()->latest();
			return DataTables::of($instance)
			                 ->addIndexColumn()
			                 ->addColumn('channel', function ($row) {
                                 return $row->channel->title;
			                 })
			                 ->editColumn('amount', function ($row) {
				                 return '$' . $row->amount;
			                 })
			                 ->editColumn('status', function ($row) {
				                 switch ($row->status) {
					                 case 0:
						                 return '<span class="badge badge-sm badge-warning">Pending</span>';
					
					                 case 1:
						                 return '<span class="badge badge-sm badge-success">Completed</span>';
					
					                 case 2:
						                 return '<span class="badge badge-sm badge-danger">Canceled</span>';
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
											<a href="'.route('user.transactions.receipt', $row->id).'" class="btn-delete dropdown-item">Receipt</a>
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['amount', 'period', 'status', 'created_at', 'actions'])
			                 ->make(true);
		}
		
		return view('user.transactions.index');
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function receipt($id)
	{
		//
	}
}
