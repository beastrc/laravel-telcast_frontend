<?php

namespace App\Http\Controllers\Network;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Yajra\DataTables\DataTables;

class OperatorController extends Controller
{
    use PasswordValidationRules;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $instance = Auth::user()->network()->first()->operators();
            return DataTables::of($instance)
                ->addIndexColumn()
                ->editColumn('email_verified_at', function ($row) {
                    if (!empty($row->email_verified_at))
                        return '<span class="badge badge-success">Verified</span>';
                    else
                        return '<span class="badge badge-danger">Unverified</span>';
                })
                ->editColumn('status', function ($row) {
                    switch ($row->status === 1) {
                        case true:
                            return '<span class="badge badge-success">Active</span>';

                        default:
                            return '<span class="badge badge-danger">Blocked</span>';
                    }
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $status = $row->status === 1 ?
                        '<a href="#!" data-url="' . route('network.operators.block', $row->operator_id) . '" class="btn-toggle dropdown-item">Block</a>' :
                        '<a href="#!" data-url="' . route('network.operators.active', $row->operator_id) . '" class="btn-toggle dropdown-item">Active</a>';

                    return
                        '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('network.operators.edit', $row->operator_id) . '" data-url-update="' . route('network.operators.update', $row->operator_id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('network.operators.destroy', $row->operator_id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
                })
                ->rawColumns(['email_verified_at', 'status', 'created_at', 'actions'])
                ->make(true);
        }

        return view('network.operators.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
            'send_verification_email' => ['sometimes', 'required'],
        ]);

        $operator = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'channel_operator'
        ]);

        // Assign operator to network
        Auth::user()->network()->first()->operators()->attach($operator);

        // Send verification email
        switch ($request->send_verification_email === 'true') {
            case true:
                event(new Registered($operator));
                break;

            default:
                $operator->update([
                    'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
                break;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully created!',
            'data' => $operator,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $operator = User::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $operator,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $operator = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($operator->id)],
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
            $operator->sendEmailVerificationNotification();
            $data['email_verified_at'] = null;
        } else {
            $data['email_verified_at'] = Carbon::now()->format('Y-m-d H:i:s');
        }

        $operator->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated!',
            'data' => $operator,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $operator = User::findOrFail($id);

        Storage::disk('public')->delete($operator->avatar);
        $operator->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully deleted!',
            'data' => $operator,
        ]);
    }

    /**
     * Active the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function active($id)
    {
        $operator = User::findOrFail($id);

        $operator->update([
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
     * @param int $id
     * @return JsonResponse
     */
    public function block($id)
    {
        $operator = User::findOrFail($id);

        $operator->update([
            'status' => 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated!',
        ]);
    }
}
