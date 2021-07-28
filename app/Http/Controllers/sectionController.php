<?php

namespace App\Http\Controllers;

use App\section;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Node\FunctionNode;

class sectionController extends Controller
{
    public function save(Request $req)
    {
        // dd($req);
        $r = Section::create([
                "name" => $req->name,
                "description" => $req->description,
                "creator" => auth()->user()->id,
                "position" => Section::all()->count(),
                "locked" => 1
            ]);

        $videos = json_decode($req->videos);

        $r->videos()->sync($videos);
        if ( $r ) {
            return redirect("dashboard/sections");
        } else {
            return back();
        }
    }
    public function update(Request $req)
    {
        $section = Section::find($req->sid);
        $r = $section->update([
            "name" => $req->name,
            "description" => $req->description
        ]);
        // dd($section);
        $videos = json_decode($req->videos);

        $section->videos()->sync($videos);
        if ($r) {
            return redirect( route("section",["sid"=>$section->id]) );
        } else {
            return redirect(route("sections"));
        }
    }
    public function show ($sid)
    {

    }
    public function edit($sid)
    {
        // Session::put("sid", $sid);
        return view('section.edit', [
            "section" => Section::find($sid)
        ]);
    }
    public function delete(Section $section)
    {
        if($section){
            $section->delete();
        }
        return back();
    }
    public function hide($sid)
    {
        return $sid;
    }

    public function nextSections(Request $request)
    {
        return json_encode(Section::with("videos")->where("position", ">", "-1")->paginate(10));
    }
}
