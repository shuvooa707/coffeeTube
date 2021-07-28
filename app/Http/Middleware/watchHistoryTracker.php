<?php

namespace App\Http\Middleware;

use App\History;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Video;


class watchHistoryTracker
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
        // if user logged in register view
        if( Auth::check() )
        {
            $video = Video::where("slug", $request->videoSlug)->get()->first();
            History::insert([
                "video_id" => $video->id,
                "user_id" => Auth::user()->id,
            ]);
        }
        return $next($request);
    }
}
