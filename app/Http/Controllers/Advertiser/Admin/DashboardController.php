<?php

namespace App\Http\Controllers\Advertiser\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('advertiser.admin.dashboard.index');
    }
}
