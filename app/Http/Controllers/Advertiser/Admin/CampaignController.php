<?php

namespace App\Http\Controllers\Advertiser\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\AdCampaign;
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

class CampaignController extends Controller
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
            $instance = Auth::user()->adCampaigns()->latest();
            return DataTables::of($instance)
                ->addIndexColumn()
                ->addColumn('geographic', function ($row) {
                    return $row->country . ' ' . $row->state . ' ' . $row->age . ' ' . $row->gender;
                })
                ->editColumn('bid', function ($row) {
                    return '$' . $row->bid;
                })
                ->editColumn('limit', function ($row) {
                    return '$' . $row->limit;
                })
                ->editColumn('status', function ($row) {
                    switch ($row->status === 1) {
                        case true:
                            return '<span class="badge badge-success">Running</span>';

                        default:
                            return '<span class="badge badge-danger">Stopped</span>';
                    }
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $status = $row->status === 1 ?
                        '<a href="#!" data-url="' . route('advertiser.campaigns.start', $row->id) . '" class="btn-toggle dropdown-item">Start</a>' :
                        '<a href="#!" data-url="' . route('advertiser.campaigns.stop', $row->id) . '" class="btn-toggle dropdown-item">Stop</a>';

                    return
                        '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('advertiser.campaigns.edit', $row->id) . '" data-url-update="' . route('advertiser.campaigns.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('advertiser.campaigns.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
                })
                ->rawColumns(['status', 'created_at', 'actions'])
                ->make(true);
        }

        return view('advertiser.campaigns.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'link' => ['required'],
            'bid' => ['required'],
            'limit' => ['required'],
            'channels' => ['sometimes']
        ]);

        $data['user_id'] = Auth::id();

        $adCampaign = AdCampaign::create($data);

        if($request->has('channels')){
            $adCampaign->channels()->sync($request->channels);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully created!',
            'data' => $adCampaign,
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
        $campaign = AdCampaign::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'campaign' => $campaign,
                'channels' => $campaign->channels
            ],
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
        $campaign = AdCampaign::findOrFail($id);

        $data = $request->validate([
            'title' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'link' => ['required'],
            'bid' => ['required'],
            'limit' => ['required'],
            'channels' => ['sometimes']
        ]);

        $data['user_id'] = Auth::id();

        $campaign->update($data);

        $campaign->channels()->sync($request->channels);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated!',
            'data' => $campaign,
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
        $campaign = AdCampaign::findOrFail($id);

        $campaign->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully deleted!',
            'data' => $campaign,
        ]);
    }

    /**
     * Active the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function start($id)
    {
        $campaign = AdCampaign::findOrFail($id);

        $campaign->update([
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
    public function stop($id)
    {
        $campaign = AdCampaign::findOrFail($id);

        $campaign->update([
            'status' => 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated!',
        ]);
    }
}
