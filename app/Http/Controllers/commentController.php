<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class commentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        return view("admin.dashboard.comments", [
            "comments" => Comment::paginate(5),
            "pageOn" => "comments"
        ]);
    }

    public function markCommentAsRead(Request $request)
    {
        $r = Comment::find($request->cid)->update([
            "read" => "read"
        ]);

        if ($r) {
            return json_encode(["status"=>"done"]);
        } else {
            return json_encode(["status"=>"error"]);
        }
    }

    public function deleteComment(Request $request)
    {
        if($r = Comment::find($request->cid)){
            $r->delete();
        } else {
            return json_encode(["status" => "error"]);
        }
        $have = json_decode($request->have);
        // dd(Comment::with("user")->where(`id NOT IN $have`)->first());
        if ($r) {
            $newComment = $r = Comment::with("user")
                ->whereIn("id", $have, "and", true)
                ->limit(1)
                ->get();
            return json_encode(["status" => "done", "comment" => $newComment ]);
        } else {
            return json_encode(["status" => "error"]);
        }
    }
}
