<?php

namespace App\Http\Controllers\Advertiser\Admin;

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

class AdvertiserController extends Controller
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
            $instance = User::where('role', 'advertiser')->latest();
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
                        '<a href="#!" data-url="' . route('advertiser.admin.advertisers.block', $row->id) . '" class="btn-toggle dropdown-item">Block</a>' :
                        '<a href="#!" data-url="' . route('advertiser.admin.advertisers.active', $row->id) . '" class="btn-toggle dropdown-item">Active</a>';

                    return
                        '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('advertiser.admin.advertisers.edit', $row->id) . '" data-url-update="' . route('advertiser.admin.advertisers.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('advertiser.admin.advertisers.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
                })
                ->rawColumns(['email_verified_at', 'status', 'created_at', 'actions'])
                ->make(true);
        }

        return view('advertiser.admin.advertisers.index');
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

        $advertiser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'advertiser'
        ]);

        // Send verification email
        switch ($request->send_verification_email === 'true') {
            case true:
                event(new Registered($advertiser));
                break;

            default:
                $advertiser->update([
                    'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
                break;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully created!',
            'data' => $advertiser,
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
        $advertiser = User::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $advertiser,
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
        $advertiser = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($advertiser->id)],
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
            $advertiser->sendEmailVerificationNotification();
            $data['email_verified_at'] = null;
        } else {
            $data['email_verified_at'] = Carbon::now()->format('Y-m-d H:i:s');
        }

        $advertiser->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated!',
            'data' => $advertiser,
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
        $advertiser = User::findOrFail($id);

        Storage::disk('public')->delete($advertiser->avatar);
        $advertiser->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully deleted!',
            'data' => $advertiser,
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
        $advertiser = User::findOrFail($id);

        $advertiser->update([
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
        $advertiser = User::findOrFail($id);

        $advertiser->update([
            'status' => 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated!',
        ]);
    }
}
