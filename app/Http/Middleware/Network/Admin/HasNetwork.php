<?php

namespace App\Http\Middleware\Network\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasNetwork
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
        if(Auth::user()->network()->exists()){
            return $next($request);
        }

        abort(403);
    }
}
