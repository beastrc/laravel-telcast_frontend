<?php

namespace App\Http\Responses;

use App\Http\Middleware\Channel;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
	/**
	 * Create an HTTP response that represents the object.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function toResponse ($request)
	{
		if ($request->wantsJson()) {
			return response()->json(['two_factor' => false]);
		}

		switch (Auth::user()->role) {
			case 'super':
				return redirect()->intended(config('fortify.admin_home'));

            case 'network_admin':
                return redirect()->intended(route('network.dashboard.index'));

            case 'channel':
			// case 'channel_operator':
				dd(Auth::user());
                // return redirect()->intended(route('channel.dashboard.index'));

            case 'advertiser_admin':
                return redirect()->intended(route('advertiser.admin.dashboard.index'));

            case 'advertiser':
				// dd(Channel::where());
                return redirect()->intended(route('advertiser.dashboard.index'));
			
			case 'campaign':
                return redirect('createcampaign');

            case 'user':
				return redirect()->intended(route('frontend.home'));
		}

		return redirect(route('login'));
	}
}
