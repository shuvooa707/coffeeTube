<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Session::put("lastPageUrl", request()->url());
        if (!Auth::check()) {
            return redirect("/login");
        }
        if( Auth::user()->role == "admin" ) {
            return $next($request);
        } else {
            return redirect("/");
        }
    }
}
