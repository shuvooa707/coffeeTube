<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class contentController extends Controller
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
    public function show(Request $request)
    {
        $type = $request->route()->getAction()['type'];
        // dd($type);
        $activeNav = ($type == "telefilms") ? "natok" : $type;
        return view($type,["page"=> $activeNav]);
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

    public function generateVideo(Request $req) {

        // foreach( $_FILES["thumbnail"] as $key ) {
        //     print_r( $key );
        //     echo "<br>";
        // }

        // exit(0);
        // dump( request()->file("video") );
        // dd( request() );

        if ( is_array($req->file("thumbnail")) ) {
            $thumbnail = $req->file("thumbnail")[0]->store("public/thumbnail");
        } else {
            $thumbnail = $req->file("thumbnail")->store("public/thumbnail");
        }
        if ( is_array($req->file("video")) ) {
            $videoName = $req->file("video")[0]->store("public/videos");
        } else {
            $videoName = $req->file("video")->store("public/videos");
        }

        // dd( $videoName );
        $isCreated = Video::create([
            "title" => $req->title,
            "slug" => $req->title,
            "description" => $req->description,
            "genre" => $req->genre,
            "type" => $req->type,
            "videoPath" =>  str_replace("public/","storage/",$videoName),
            "thumbnail" => str_replace("public/","storage/",$thumbnail),
            "user_id" => auth()->user()->id
        ]);

        if ($isCreated) {
            // return back();
            return redirect( route("videogalary") );
        }
    }

    public function editVideo(Request $req) {
        // Save Video
        $videoName = $req->file("video")->store("/public/videos");
        // Save Video Thumbnail
        $thumbnail = $req->file("thumbnail")->store("/public/thumbnail");
        // file( Video::find($req->id)->videoPath )->delete();
        // file(Video::find($req->id)->thumbnail)->delete();
        $edited = Video::find( $req->id )->update([
            "title" => $req->title,
            "slug" => $req->title,
            "description" => $req->description,
            "genre" => $req->genre,
            "type" => $req->type,
            "videoPath" => "storage/videos/" . explode("public/videos/", $videoName)[1],
            "thumbnail" => "storage/thumbnail/" . explode("public/thumbnail/", $thumbnail)[1],
        ]);


        if( $edited ) {
            return redirect("/");
        }
    }

    public function actionTest(Request $req) {
        dd($req);
    }

    public function getsection(Request $req) {
        $lastSection = $req->lastsection;

        return view('partials.section',["sectionName"=>"Most Viewed", "sectionClassName"=>"most-viewed","videoList"=>[]]);
    }
    public static function topTrending(){
        return Video::all();
    }
}
