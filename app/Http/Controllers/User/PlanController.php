<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::all();
        return view('user.plans.index', compact('plans'));
    }

    /**
     * Subscribe/upgrade a subscription plan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Plan $plan, $period)
    {
	    return redirect()->route('user.payment.paypal', [
		    'period' => $period,
		    'plan'   => $plan->id,
	    ]);
    }
}
