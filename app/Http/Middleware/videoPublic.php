<?php

namespace App\Http\Middleware;

use App\Video;
use Closure;

class videoPublic
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
        // dd($request->video);
        $video = Video::find($request->video);
        if ( isset($video) && $video->public == "public" ) {
            return $next($request);
        } else {
            return back();
        }
    }
}
