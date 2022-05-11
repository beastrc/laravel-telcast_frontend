<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubscriptionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$instance = Subscription::latest();
			return DataTables::of($instance)
			                 ->addIndexColumn()
			                 ->addColumn('user', function ($row) {
				                 if (!empty($row->user)) {
					                 return $row->user->name;
				                 }
				
				                 return 'Undefined';
			                 })
			                 ->addColumn('plan', function ($row) {
				                 if (isset($row->plan) && !empty($row->plan)) {
					                 return $row->plan->title;
				                 }
				
				                 return 'Undefined';
			                 })
			                 ->editColumn('period', function ($row) {
				                 switch ($row->period) {
					                 case 'monthly':
						                 return "<span class='badge badge-info'>$row->period</span>";
					
					                 case 'yearly':
						                 return "<span class='badge badge-warning'>$row->period</span>";
				                 }
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
			                 ->editColumn('expired_at', function ($row) {
				                 $expired_at = '';
				                 
				                 if (Carbon::now()->gt($row->expired_at)) {
					                 $expired_at .= '<span class="badge badge-sm badge-danger">Expired</span> ';
				                 }
				                 
				                 $expired_at .= $row->expired_at;
				
				                 return $expired_at;
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
											<a href="' . route('user.transactions.receipt', $row->id) . '" class="btn-delete dropdown-item">Change Plan</a>
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['user', 'plan', 'period', 'status', 'expired_at', 'created_at', 'actions'])
			                 ->make(true);
		}
		
		return view('admin.subscriptions.index');
	}
}
