<?php

namespace App\Http\Controllers\Network;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Live;
use App\Models\Network;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $instance = Channel::latest();
            return DataTables::of($instance)
                ->addIndexColumn()
                ->editColumn('logo', function ($row) {
                    return '<img src="' . asset("storage/$row->logo") . '" class="img-fluid img-thumbnail">';
                })
                ->editColumn('status', function ($row) {
                    switch ($row->status === 1) {
                        case true:
                            return '<span class="badge badge-sm badge-success">Published</span>';

                        default:
                            return '<span class="badge badge-sm badge-warning">Unpublished</span>';
                    }
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $status = $row->status === 1 ?
                        '<a href="#!" data-url="' . route('network.channels.unpublish', $row->id) . '" class="btn-toggle dropdown-item">Unpublish</a>' :
                        '<a href="#!" data-url="' . route('network.channels.publish', $row->id) . '" class="btn-toggle dropdown-item">Publish</a>';

                    return
                        '<div class="dropdown">
									    <button class="btn btn-sm btn-circle btn-light" data-toggle="dropdown">
									        <i class="fas fa-ellipsis-v text-secondary"></i>
									    </button>
									    <div class="dropdown-menu dropdown-menu-right">
											<a href="#!" data-url-edit="' . route('network.channels.edit', $row->id) . '" data-url-update="' . route('network.channels.update', $row->id) . '" data-toggle="modal" data-target="#edit-modal" class="dropdown-item">Edit</a>
											<a href="#!" data-url="' . route('network.channels.destroy', $row->id) . '" class="btn-delete dropdown-item">Delete</a>
											' . $status . '
									    </div>
									</div>';
                })
                ->rawColumns(['logo', 'status', 'created_at', 'actions'])
                ->make(true);
        }

        return view('network.channels.index');
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
            'category_id' => ['required'],
            'title' => ['required'],
            'logo' => ['required'],
            'background' => ['required'],
            'description' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'operators' => ['sometimes']
        ]);

        $data['user_id'] = Auth::id();
        $data['logo'] = Storage::disk('public')->putFile('logos/network', $request->logo);
        $data['background'] = Storage::disk('public')->putFile('backgrounds/network', $request->logo);

        $channel = Channel::create($data);

        // Assign operators
        if ($request->has('operators')) {
            $channel->operators()->sync($request->operators);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully created!',
            'data' => $channel
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit(Channel $channel)
    {
        return response()->json([
            'status' => true,
            'data' => [
                'channel' => $channel,
                'category' => $channel->category,
                'operators' => $channel->operators
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, Channel $channel)
    {
        $data = $request->validate([
            'category_id' => ['required'],
            'title' => ['required'],
            'logo' => ['sometimes'],
            'background' => ['sometimes'],
            'description' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'operators' => ['sometimes'],
        ]);

        $data['user_id'] = Auth::id();
        $data['logo'] = $request->has('logo') ? Storage::disk('public')->putFile('logos/network', $request->logo) : $channel->logo;
        $data['background'] = $request->has('background') ? Storage::disk('public')->putFile('backgrounds/network', $request->background) : $channel->background;

        $channel->update($data);

        // Assign operators
        $channel->operators()->sync($request->operators);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully updated!',
            'data' => $channel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Channel $channel)
    {
        Storage::disk('public')->delete($channel->logo);
        Storage::disk('public')->delete($channel->background);
        $channel->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully deleted!',
        ]);
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param Live $live
     * @return Response
     */
    public function publish(Channel $channel)
    {
        $channel->update([
            'status' => 1,
        ]);

        return response([
            'status' => true,
            'message' => 'Successfully updated!',
        ]);
    }

    /**
     * Unpublish the specified resource from storage.
     *
     * @param Live $channel
     * @return Response
     */
    public function unpublish(Channel $channel)
    {
        $channel->update([
            'status' => 0,
        ]);

        return response([
            'status' => true,
            'message' => 'Successfully updated!',
        ]);
    }
}
