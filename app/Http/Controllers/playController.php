<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Like;


class playController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($videoSlug, Request $req)
    {
        // making the comment "read" if it is referral
        if ( $cid = request("cid") ) {
            $r = Comment::find($cid)->update([
                "read" => "read"
            ]);
        }
        // Fetching the Video with Comment
        $video = Video::with("comments")->get()->where("slug", $videoSlug)->first();
        // dd($video);
        if (Auth::check()) {
            # code...
            $isSaved = Favorite::all()->where("video_id", "=", $video->id)->where("user_id", "=", Auth::user()->id)->count();
        } else {
            $isSaved = null;
        }
        if (Auth::check()) {
            # code...
            $liked = Like::where("video_id", "=", $video->id)->where("user_id", "=", Auth::user()->id)->get()->count();
        } else {
            $liked = null;
        }
        // dd(Auth::user()->id);
        // dd($video->id);
        // dd(Favorite::all()->where("video_id", "=", $video->id)->where("user_id", "=", Auth::user()->id));
        if(!$video) {
            return back();
        }
        return view("play", [
            "page" => "play",
            "video" => $video,
            "rvideos" => $this->rvideos($video),
            "isSaved" => $isSaved,
            "liked" => $liked,
            "disliked" => !$liked
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // returns all the recommended videos
    public function rvideos($video)
    {
        return Video::limit(8)
                ->where("genre","=", $video->genre)
                ->where("id","!=", $video->id)
                ->orderBy("rating")
                ->get()
                ->map(function($video){
                    $video->title = Str::substr($video->title,0,92);
                    return $video;
                });
    }
}
