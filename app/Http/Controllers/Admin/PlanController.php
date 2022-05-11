<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PlanController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$instance = Plan::latest();
			return DataTables::of($instance)
			                 ->addIndexColumn()
			                 ->editColumn('features', function ($row) {
				                 $features = '';
				
				                 foreach ($row->features as $index => $feature) {
				                 	switch ($index){
					                    case 'quality':
						                    $features .= '<span class="badge badge-sm badge-dark">Video Quality: ' . $feature . '</span>';;
						                    break;
						                    
					                    case 'ad_free_entertainment':
						                    $features .= '<span class="badge badge-sm badge-dark">Ad Free Entertainment: ' . $feature . '</span>';;
					                    	break;
				                    }
				                 }
				
				                 return $features;
			                 })
			                 ->editColumn('status', function ($row) {
				                 switch ($row->status === 1) {
					                 case true:
						                 return '<span class="badge badge-sm badge-success">Enabled</span>';
					
					                 default:
						                 return '<span class="badge badge-sm badge-warning">Disabled</span>';
				                 }
			                 })
			                 ->editColumn('created_at', function ($row) {
				                 return $row->created_at->diffForHumans();
			                 })
			                 ->addColumn('actions', function ($row) {
				                 $status = $row->status === 1 ?
					                 '<a href="#!" data-url="' . route('admin.plans.disable', $row->id) . '" class="btn-toggle dropdown-item">Disable</a>' :
					                 '<a href="#!" data-url="' . route('admin.plans.enable', $row->id) . '" class="btn-toggle dropdown-item">Enable</a>';
				
				                 return
					                 '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('admin.plans.edit', $row->id) . '" data-url-update="' . route('admin.plans.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('admin.plans.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['features', 'status', 'created_at', 'actions'])
			                 ->make(true);
		}
		
		return view('admin.plans.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request)
	{
		$data = $request->validate([
			'title' => ['required', 'string', 'unique:plans'],
			'price' => ['required', 'numeric'],
			'price_discount' => ['required', 'numeric'],
			'price_annual' => ['required', 'numeric'],
			'price_annual_discount' => ['required', 'numeric'],
			'features.*' => ['required'],
		]);
		
		$plan = Plan::create($data);
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully created!',
			'data' => $plan,
		]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Plan $plan
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Plan $plan)
	{
		return response()->json([
			'status' => 'success',
			'data' => $plan,
		]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Plan         $plan
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Plan $plan)
	{
		$data = $request->validate([
			'title' => ['required', 'string', 'unique:plans'],
			'price' => ['required', 'numeric'],
			'price_discount' => ['required', 'numeric'],
			'price_annual' => ['required', 'numeric'],
			'price_annual_discount' => ['required', 'numeric'],
			'features.quality' => ['required', 'string'],
		]);
		
		$plan = $plan->update($data);
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully updated!',
			'data' => $plan,
		]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Plan $plan
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Plan $plan)
	{
		$plan->delete();
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully deleted!',
		]);
	}
	
	/**
	 * Enable the specified resource from storage.
	 *
	 * @param  \App\Models\Plan $plan
	 * @return \Illuminate\Http\Response
	 */
	public function enable(Plan $plan)
	{
		$plan->update([
			'status' => 1
		]);
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully updated!',
		]);
	}
	
	/**
	 * Disable the specified resource from storage.
	 *
	 * @param  \App\Models\Plan $plan
	 * @return \Illuminate\Http\Response
	 */
	public function disable(Plan $plan)
	{
		$plan->update([
			'status' => 0
		]);
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully updated!',
		]);
	}
}
