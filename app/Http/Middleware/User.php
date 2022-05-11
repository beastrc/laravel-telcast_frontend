<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
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
	    switch(Auth::user()->role){
		    case 'admin':
			    return redirect()->route('admin.dashboard.index');
			    
		    case 'user':
		        return $next($request);
	    }
	
	    abort(403);
    }
}
