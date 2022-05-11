<?php

namespace App\Http\Middleware\Network;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role === 'network_admin'){
            return $next($request);
        }

        abort(404);
    }
}
