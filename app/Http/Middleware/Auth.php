<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth as AuthClass;
use Illuminate\Support\Facades\Session;

class Auth
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
        if ( AuthClass::check() ) {
            return $next($request);
        } else {
            return redirect("/login");
        }

    }
}
