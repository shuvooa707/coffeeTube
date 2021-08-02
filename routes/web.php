<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Comment;
use App\Events\testEvent;
use App\Favorite;
use App\Like;
use App\Video;
use App\section;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;


Route::get('/',[
    "uses" => "HomeController@show"
]);

Route::get('/play/{videoSlug?}/{cid?}','playController@show')->middleware("trackView")->name('playvideo');
Route::post('/play/like', function (Request $req) {
    $found = Like::where("video_id", "=", $req->vid)->where("user_id", "=", Auth::user()->id)->get();
    if( !$found->count() ){
        Like::insert([
            "type" => "like",
            "video_id" => $req->vid,
            "user_id" => Auth::user()->id
        ]);
        return "liked";
    } else {
        if( $found->first()->type == "dislike" ){
            Like::insert([
                "type" => "like",
                "video_id" => $req->vid,
                "user_id" => Auth::user()->id
            ]);
            $found->first()->delete();
            return "liked";
        }
        $found->first()->delete();
        return "unliked";
    }
})->middleware("auth");

Route::post('/play/dislike', function (Request $req) {
    $found = Like::where("video_id", "=", $req->vid)->where("user_id", "=", Auth::user()->id)->get();
    if (!$found->count()) {
        Like::insert([
            "type" => "dislike",
            "video_id" => $req->vid,
            "user_id" => Auth::user()->id
        ]);
        return "disliked";
    } else {
        if ($found->first()->type == "like") {
            Like::insert([
                "type" => "dislike",
                "video_id" => $req->vid,
                "user_id" => Auth::user()->id
            ]);
            $found->first()->delete();
            return "disliked";
        }
        $found->first()->delete();
        return "undisliked";
    }
})->middleware("auth");

// Route::get('/getDataAjaxScroll/{sectionName}', 'ajaxDataController@get')->name('getDataAjaxScroll');

Route::get("/getSectionOnScrollAjax", "sectionController@nextSections")->name("getSection");


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/movies', [
    "uses" => "contentController@show",
    "type" => "movies"
])->name('movies');

Route::get('/tv', [
    "uses" => "contentController@show",
    "type" => "tv",
    "as" => "tv"
]);

Route::get('/natok', [
    "uses" => "contentController@show",
    "type" => "telefilms"
])->name('natok');

Route::get("/search", [
    "uses"=>"searchController@index",
    "type"=>"search",
])->name('search');



Route::get("/login", function (Request $req) {
    if( Auth::check() ) {
        return redirect("dashboard");
    } else {
        return view("auth.login");
    }
})->name("login");


Route::get("/register", function (Request $req) {
    if( Auth::check() ) {
        Auth::logout();
    }
    return view("auth.register");
})->name("register");

Route::post('/register',function(Request $req){
    $profileThum = $req->file("profileThum")->store("public/profilepics");
    // dd($profileThum);
    $regSuccess = User::insert([
        "name" => $req->firstname,
        "username" => $req->username,
        "age" => $req->age,
        "gender" => $req->gender,
        "email" => $req->email,
        "password" => bcrypt($req->password),
        "profilepic" => "storage/profilepics/" . explode("public/profilepics/",$profileThum)[1]
    ]);

    // dd($regSuccess);
    if($regSuccess) {
        $check = Auth::attempt([
            "username" => $req->username,
            "password" => $req->password,
        ]);
        if ($check) {
            return redirect("profile");
        }
    } else {
        return redirect("auth.register");
    }

})->name('saveNewUserRegistration');


// ******* // checks login
Route::post("/login",function(Request $req) {
    $check = Auth::attempt([
        "username" => $req->username,
        "password" => $req->password,
    ]);
    // dd($check);
    if( $check ) {
        if ($lastPageUrl = session("lastPageUrl")) {
            return redirect($lastPageUrl);
        } else {
            return redirect("/");
        }

    } else {
        return redirect("login");
    }

})->name("attemptLogin");


Route::get("dashboard", function(){
    return view("admin.dashboard.studio", [
        "pageOn" => "studio"
    ]);
})->middleware(["auth", 'admin'])->name("dashboard");



Route::get("dashboard/create", function () {
    return view("admin.create");
})->middleware("auth", 'admin')->name("video.create");


Route::get("dashboard/video/edit/{vid}", function ($vid) {
    $v = Video::find($vid);
    return view("admin.edit",["video"=>$v]);
})->middleware("auth", 'admin')->name("video.edit");

Route::post("dashboard/video/edit", "contentController@editVideo")->middleware("auth", 'admin')->name("video.saveedited");



Route::get("dashboard/video/delete", function (Request $req) {

    if ($id = $req->vid) {
        // dd($id);
        $video = Video::find($id);
        File::delete( $video->videoPath );
        $video->delete();
        return back();
    } else {
        if ($lastPageUrl = session("lastPageUrl")) {
            return redirect($lastPageUrl);
        } else {
            return back();
        }
    }

})->middleware("auth", 'admin')->name("video.delete");


Route::get("/profile", function () {
    $user = User::find(auth()->user()->id);
    return view("profile", ["user" => $user]);

})->middleware("auth")->name("profile");

// Route::get("/user/{uid?}", function($uid){
//     if ( $uid == Auth::user()->id ) {
//         return redirect("/profile");
//     }
//     dd($uid);
// })->name("user");


Route::get("/logout", function () {
    Auth::logout();

    return redirect("/");
});


Route::get("/getRecommendedVideos", "getContentController@getRecommendedVideos");

Route::post("video/generate", "contentController@generateVideo")->middleware("auth")->name("video.generate");




// Route::get("videos/{sid}", function ($sid, Request $req) {
//     $section = Section::find($sid);
//     // dd( $videos );
//     return view("videolist", [
//         "section" => $section,
//         "videos" => Video::all()
//     ]);
// })->name("videolist");



// Route::get("/getsection", "contentController@getsection")->name("getsection");
Route::get("/dashboard/sections/getmoresections", function (Request $request) {
    // \sleep(0);
    $ids = json_decode($request->ids);
    // dd($ids);
    $r = Section::with("videos")
        ->whereIn("id", $ids, "and", true)
        ->limit(5)
        ->get()
        ->toArray();

    $r = array_map(function($r){
        $r["isAdmin"] = Auth::check() && Auth::user()->role == "admin";
        // $r["sectionClassName"] = Str::slug( $r->title );
        return $r;
    },$r);

    return $r;

})->name("section.getmore");


Route::get("/section/show/{sid}", function ($sid = null) {
    // dd(Section::find($sid));
    if (!$sid) {
        return redirect("/");
    }
    if ( !is_nan($sid) ) {
        return view("section.show", [
            "section" => Section::find($sid)
        ]);
    } else {
        return view("section.create");
    }

})->name("section");


Route::group(["middleware"=>["admin", "auth"]], function() {

    Route::get("/section/create", function() {
        return view("section.create");
    })->name("section.create");

    Route::post("/section/save",[
        "uses" => "sectionController@save"
    ])->name("section.create.save");

    Route::post("/section/update",[
        "uses" => "sectionController@update"
    ])->name("section.update.save");

    // Route::get("/delete/{id}", function ($id) {
    //     // $deleted = $vid->delete();

    //     if ($id = $id) {
    //         $video = Video::find($id);
    //         File::delete($video->videoPath);
    //         $video->delete();
    //         return back();
    //     } else {
    //         return redirect("dashboard");
    //     }

    // })->name("deleteVideo");

    Route::get("/deleteall", function () {
        $v = Video::all();
        foreach ($v as $vid) {
            $vid->delete();
        }
        return back();
    })->name("deleteall");

    Route::get("dashboard/galary", function () {
        return view("admin.dashboard.galary", [
            "videos" => Video::with("comments")->paginate(request()->perPage ?? 7),
            "totalvideos" => Video::all()->count(),
            "pageOn" => "galary",
            "perPage" => request()->perPage ?? 7
        ]);
    })->name("videogalary");

    Route::get("dashboard/comments",[
        "uses" => "commentController@index"
    ])->name("comments")->middleware(["auth", "admin"]);

    Route::get("dashboard/comments/markCommentAsRead", [
        "uses" => "commentController@markCommentAsRead"
    ])->name("comment.markread");

    Route::get("dashboard/comments/deleteComment", [
        "uses" => "commentController@deleteComment"
    ])->name("comment.delete");

    Route::get("dashboard/analytics", function () {
        return view("admin.dashboard.analytics", [
            "videos" => Video::paginate(20),
            "pageOn" => "analytics"
        ]);
    })->name("analytics");
    Route::get("dashboard/reports", function () {
        return view("admin.dashboard.report", [
            "videos" => Video::paginate(20),
            "pageOn" => "reports"
        ]);
    })->name("reports");



    Route::get("/dashboard/sections", [
        "uses" => "dashboardController@sections",
    ])->name("sections");


    Route::get("/dashboard/sections/section/edit/{sid?}", [
        "uses" => "sectionController@edit"
    ])->name("section.edit");

    Route::get("/dashboard/sections/section/{sid}/delete", [
        "uses" => "sectionController@delete"
    ])->name("section.delete");

    Route::get("/dashboard/sections/section/{sid}/hide", [
        "uses" => "sectionController@hide"
    ])->name("section.hide");


    Route::post("/dashboard/sections/order", function(Request $req){
        Section::where("position", ">", $req->newpos)->get()->each(function($section){
            $section->update([
                "position" => $section->position + 1
            ]);
        });

        Section::find($req->sid)->update([
            "position" => $req->newpos
        ]);
    });

    Route::get("/findvideoajax", function(Request $req){
        if( count(json_decode($req->have)) ) {
            $have = json_decode($req->have);
            $tmphave = "";
            $last = 1;
            foreach ($have as $value) {
                $tmphave .= "'$value'";
                if (count($have) != $last) {
                    $tmphave .= ",";
                }
                $last++;
            }
            $query = "select * from Videos Where title like '%$req->key%' AND id NOT IN ($tmphave)";
        } else {
            $query = "select * from Videos Where title like '%$req->key%'";
        }
        // dd("select * from Videos Where title like '%$req->key%' AND id NOT IN ($tmphave)");
        $r = DB::select( $query );
    $videos = [];
        foreach ($r as $video) {
            $videos[] = $video;
        }
        return json_encode($videos);
    });

    Route::get("/dashboard/sections/delete/{sid}", function($sid){
        $r = Section::find($sid);
        if($r){
            $r->delete();
            return back();
        } else {
            return back();

        }
    })->name("section.delete");

    Route::post("/section/delete/multiple", function(Request $request){
        dump("DELETE FROM sections WHERE id IN $request->sections");
        $r = DB::query("DELETE FROM sections WHERE id IN $request->sections");
        if($r) {
            return json_encode(["status"=>"done"]);
        } else {
            return json_encode(["status"=>"error"]);
        }
    });

    Route::get("dashboard/sections/locksection/{sid}",function($sid){
        $section = Section::find($sid);
        $isWhat = $section->locked;
        $section->update([
            "locked" => !$isWhat
        ]);
        if($isWhat) {
            return "locked";
        } else {
            return "unlocked";
        }
    });


    // Administration Routes
    Route::get("dashboard/administration", [
        "uses" => "AdministrationController@show"
    ])->name("administration");

    Route::get("dashboard/administration/moderateuser/{uid?}",[
        "uses" => "AdministrationController@moderateUser"
    ])->name("administration.moderateuser");


    Route::post("/dashboard/administration/moderateuser/block", function(Request $request){
        $uid = $request->id;
        if(!$uid || !is_integer($uid)){
            return;
        }
        $user = User::find($request->id);

        $user->update([
            "blocked" => !$user->blocked
        ]);
        return json_encode([
            "status" => "success"
        ]);
    });

});



Route::get("section/{sid?}", function ($sid = null) {
    if ( !$sid ) {
        return redirect("/");
    }
    $section = Section::first($sid);
    // dd( $videos );
    return view("videolist", [
        "section" => $section,
        "videos" => $section->videos
    ]);
})->name("videolist");




Route::get("getsection/{offset?}", function( $offset = 0 ) {
    if($offset) {
        $sections = Section::all()->where("position",">=", $offset);
        return view("section.template", [
            "sections" => $sections
        ]);
    } else {
        $sections = DB::select("select * from sections Limit 3");
        return view("section.template", [
            "sections" => $sections
        ]);
    }
})->name("getsection");




// Route::get("/old", function (Request $req) {
//     return view("old");
// });
// Route::post("/old", function (Request $req) {
//     $req->validate([
//         "name" => "string|min:10",
//         "age" => "string|min:10",
//     ]);
//     return "200";
// });



Route::post("/fetchPost", function(Request $request){
    return explode("bearer", $request->header("Authorization"))[1];
});
Route::post("/comment/create", function(Request $request){
    $r = Comment::insert([
        "content" => $request->content,
        "user_id" => Auth::user()->id,
        "video_id" => $request->video_id,
    ]);
    return json_encode($r);
})->name("comment.create")->middleware("auth");



Route::get("/session", function(Request $request){
    Session::put("whereToGo","dashboard");
    Session::remove("whereToGo");
    Session::put("whereToGo","dashboard");
    // return dd( app("url") );
    // back();

    dd( request()->url() );

    $rc = new ReflectionClass(Session::class);
    dump($rc);
    return dd( session("_previous")["url"] );
});



// Api Routes

Route::group(["prefix" => "api"], function () {
    Route::get("/comment/{cid}", function ($cid) {
        $commentObj = Comment::find($cid);
        $comment = $commentObj->toArray();
        $comment["link"] = url("") ."/play/". $commentObj->video->slug;
        return "<pre>" . json_encode($comment) . "<pre>";
    });
    Route::get("/comments", function () {
        return json_encode(Comment::all()->toArray());
    });
});


Route::get("user/{uid?}", function($uid){
    // dd($uid);
    $user = User::find($uid);
    if( Auth::user()->id == $user->id ){
        return redirect("/profile");
    }
    // dd($user);
    return view("user",[
        "user" => $user
        ]);
})->name("user");


Route::get("notification", [
    "uses" => "notificationController@show"
])->middleware("auth")->name("notification");



Route::get("headers", function(){
    dd($_SERVER);
});



Route::get("/comp", function(){
    $arr = array(
        'a' => array(
            'b' => array(
                'c' => 100,
            )
        ),
        'x' => array(),
    );


    var_dump($arr);



    function run(&$arr, $source, $value)
    {

        $targetKeys = array_keys($arr);

        // dump($targetKeys);


        $sourceKeys = array_keys($source);
        $targetLen = count($targetKeys);
        $sourceLen = count($sourceKeys);


        if ($sourceLen == 1) {
            $arr[array_shift($source)] = $value;
            return $arr;
        } else {
            $tmpKey = array_shift($source);
            if( isset($arr[$tmpKey]) ) {
                $tmp = &$arr[$tmpKey];
            } else {
                $arr[$tmpKey] = [];
                $tmp = &$arr[$tmpKey];
            }
            return run($tmp, $source, $value);
        }
    }

    run($arr, ["a"], [777,888,999]);
    var_dump($arr);
});

Route::get("/make", function(){
    return "check";
});

//


