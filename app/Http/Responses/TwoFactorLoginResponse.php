<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;

class TwoFactorLoginResponse implements TwoFactorLoginResponseContract
{
	/**
	 * Create an HTTP response that represents the object.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function toResponse($request)
	{
		if ($request->wantsJson()) {
			return new JsonResponse('', 204);
		}
		
		switch (Auth::user()->role) {
			case 'admin':
				return redirect()->intended(config('fortify.admin_home'));
			
			case 'user':
				return redirect()->intended(config('fortify.home'));
		}
		
		return redirect(route('login'));
    }
}
