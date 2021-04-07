<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Closure;

class IsOfficer
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
        if(auth()->guard('tester_officer')->check()){
            return $next($request);
        }
        return redirect()->route('unauth');
        // return redirect()->route('form_login');
        // return $next($request);
    }
}
