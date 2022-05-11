<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        switch($id) {
            case 0:
                return view('auth.login');
                break;
            case 1:
                return view('auth.channellogin');
                break;
            case 2:
                return view('auth.campaignlogin');
                break;
            case 3:
                return view('auth.advertiselogin');
                break;
            
        }
    }

    public function login(Request $request, $id, User $user)
    {
        $data = $request->input();

        $password = $data['password'];
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $userid = $user->id;
            switch($id){
                case 1:
                    return view('channel.dashboard.index', compact('userid'));
                    break;
                case 2:
                    return view('advertiser.campaigns.create', compact('userid'));
                    // return view('advertiser.campaigns.test');
                    break;
                case 3:
                    return view('advertiser.admin.dashboard.index', compact('userid'));
                    break;
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
