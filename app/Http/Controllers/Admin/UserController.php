<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
	use PasswordValidationRules;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$instance = User::whereNotIn('id', [Auth::id()]);
			return DataTables::of($instance)
			                 ->addIndexColumn()
			                 ->editColumn('email_verified_at', function ($row) {
				                 if (!empty($row->email_verified_at))
					                 return '<span class="badge badge-success">Verified</span>';
				                 else
					                 return '<span class="badge badge-danger">Unverified</span>';
			                 })
			                 ->editColumn('role', function ($row) {
				                 switch ($row->role) {
					                 case 'admin':
						                 return '<span class="badge badge-success">Admin</span>';
					
					                 case 'user':
						                 return '<span class="badge badge-dark">User</span>';
				                 }
			                 })
			                 ->editColumn('status', function ($row) {
				                 switch ($row->status === 1) {
					                 case true:
						                 return '<span class="badge badge-success">Active</span>';
					
					                 default:
						                 return '<span class="badge badge-danger">Block</span>';
				                 }
			                 })
			                 ->editColumn('created_at', function ($row) {
				                 return $row->created_at->diffForHumans();
			                 })
			                 ->addColumn('actions', function ($row) {
				                 $status = $row->status === 1 ?
					                 '<a href="#!" data-url="' . route('admin.users.block', $row->id) . '" class="btn-toggle dropdown-item">Block</a>' :
					                 '<a href="#!" data-url="' . route('admin.users.active', $row->id) . '" class="btn-toggle dropdown-item">Active</a>';
				
				                 return
					                 '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('admin.users.edit', $row->id) . '" data-url-update="' . route('admin.users.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('admin.users.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
			                 })
			                 ->rawColumns(['email_verified_at', 'role', 'status', 'created_at', 'actions'])
			                 ->make(true);
		}
		
		return view('admin.users.index');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// Validate request
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
			'password' => $this->passwordRules(),
			'send_verification_email' => ['sometimes', 'required'],
		]);
		
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);
		
		// Send verification email
		switch ($request->send_verification_email === 'true') {
			case true:
				event(new Registered($user));
				break;
			
			default:
				$user->update([
					'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
				]);
				break;
		}
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully created!',
			'data' => $user,
		]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		return response()->json([
			'status' => 'success',
			'data' => $user,
		]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		// Validate request
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
			'password' => ['nullable', 'string', new Password, 'confirmed'],
			'send_verification_email' => ['required'],
		]);
		
		// Create data array
		$data = [
			'name' => $request->name,
			'email' => $request->email,
		];
		
		// Check if password is updated or not
		if ($request->password) {
			$data['password'] = Hash::make($request->password);
		}
		
		// Check if email is to be verified or set as verified
		if ($request->send_verification_email === 'true') {
			$user->sendEmailVerificationNotification();
			$data['email_verified_at'] = null;
		} else {
			$data['email_verified_at'] = Carbon::now()->format('Y-m-d H:i:s');
		}
		
		$user->update($data);
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully updated!',
			'data' => $user,
		]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		Storage::disk('public')->delete($user->avatar);
		$user->delete();
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully deleted!',
			'data' => $user,
		]);
	}
	
	/**
	 * Active the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function active(User $user)
	{
		$user->update([
			'status' => 1,
		]);
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully updated!',
		]);
	}
	
	/**
	 * Block the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function block(User $user)
	{
		$user->update([
			'status' => 0,
		]);
		
		return response()->json([
			'status' => 'success',
			'message' => 'Successfully updated!',
		]);
	}
}
