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






// profile routes
Route::get("/profile/{pid}/edit", function ($pid) {
    return view("profile.edit", ["user" => auth()->user()]);
})->name("profile.edit")->middleware("auth");

Route::get("/profile/{pid}/delete", function ($pid) {
    return $pid;
})->name("profile.delete")->middleware("auth");;

Route::get("/profile/{pid}/lock", function ($pid) {
    return $pid;
})->name("profile.lock")->middleware("auth");;

Route::post("/profile/edit/save", function (Request $req) {
    // dd( request()->file("profilepic") );
    $req->validate([
        "name" => "string",
        "email" => "email",
        "password" => "string|min:5"
    ]);
    if (strlen(App\User::all()->where("username", "=", $req->username)->where("id", "!=", auth()->user()->id)->toJson()) > 10) {
        return back();
    }

    // dd($req->file("profilepic"));
    if ($req->file("profilepic")) {
        $profilePic = $req->file("profilepic")->store("public/profilepics");
        $r = auth()->user()->update([
            "name" => $req->name,
            "username" => $req->username,
            "email" => $req->email,
            "age" => $req->age,
            "gender" => $req->gender,
            "profilepic" => "/storage/app/" . $profilePic,
            "password" => bcrypt($req->password)
        ]);
    } else {
        $r = auth()->user()->update([
            "name" => $req->name,
            "username" => $req->username,
            "email" => $req->email,
            "age" => $req->age,
            "gender" => $req->gender,
            "password" => bcrypt($req->password)
        ]);
    }
    if ($r) {
        return redirect("/profile");
    }
})->name("profile.edit.save")->middleware("auth");;

Route::get("profile/favorites", function () {
    $fvideos = Favorite::all()->where("user_id", "=", Auth::user()->id)->pluck("video_id")->toArray();
    // dd($fvideos);
    $fvideos = Video::all()->whereIn("id", $fvideos);
    return view("profile.favorites", [
        "fvideos" => $fvideos
    ]);
})->name("videos.favorites");

Route::get("/favorites/remove/all", function () {
    DB::table("favorites")->delete();
    return back();
})->name("remove.favorites.all");

Route::get("profile/watch-history", function () {
    $hvideos = App\History::all()->where("user_id", "=", Auth::user()->id)->pluck("video_id")->map(function ($vid) {
        return Video::find($vid);
    });
    // dd($hvideos);
    // $hvideos = Video::all()->whereIn("id", $hvideos);
    return view("profile.watchhistory", [
        "hvideos" => $hvideos
    ]);
})->name("videos.history");

Route::post("/favorite/save", function () {
    // dd(Auth::user()->id);
    $r = Favorite::insert([
        "video_id" => request()->vid,
        "user_id" => Auth::user()->id
    ]);
    if ($r) {
        echo "saved";
    }
})->middleware("auth");

Route::post("/favorite/remove", function () {
    $r = Favorite::limit(1)->where("video_id", "=", request()->vid)->where("user_id", "=", Auth::user()->id);
    // dd($r);

    if ($r) {
        $r->delete();
        echo "removed";
    }
})->middleware("auth");
