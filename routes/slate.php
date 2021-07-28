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
use App\Like;
use App\Video;
use App\section;
use App\sections\SectionManager;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Routing\Redirector;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use League\CommonMark\Extension\Table\Table;
use SebastianBergmann\Diff\Chunk;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;



// test routes


Route::get("/file", function () {
    // return public_path("storage/videos");
    print("<pre>");
    $allfiles = File::allFiles(public_path("storage/videos"));
    $allfiles = array_map(function ($file) {
        return "/storage/videos/" . $file->getFilename();
    }, $allfiles);
    // print_r(public_path("/storage/videos/".$allfiles[3]));

    // echo count($allfiles);

    // print(json_encode([1,3]));

    print_r(Section::find(1)->videos);
});



Route::get("/mmr", function () {
    $sec1 = Section::first();
    $video1 = Video::paginate(10);

    $sec1->videos()->attach([1, 2, 3, 4, 10]);

    // dd( Section::with("videos")->first()->toArray() );
});



Route::get("realpath", function () {
    $apple = "Mango";
    echo "$apple :: " . base64_encode($apple) . "<br>";
});

// "SELECT IN" in eloquent
Route::get("dbq", function () {
    $r = DB::table("sections")
        ->whereIn("id", [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15], "and", true)
        ->limit(5)
        ->get();
    dump($r);
});

//  Learning & Testing
Route::get("pluck", function () {
    // dd( Video::find(344)->likes->count() );
    // $v = Video::find(344);
    // dd( $v->likeCount() );

    return redirect(action("HomeController@index", 12));
});


Route::get("tap", function () {
    tap(app("request")->url(), function ($arg) {
        echo $arg;
    });
});


Route::get("where", function () {
    $r = Collection::wrap(DB::query("select * from videos where title like '%a%'"))->toArray();
    // dd(Video::all()->where("id",">" ,"5"));
    dd($r);
});

Route::get("readfile", function () {
    header('Content-Type: image/png');

    readfile("D:\code\PHP\Projects\blueTube_(3-100)\public\storage\img\middlw.PNG");
    // $cont = file_get_contents("D:\code\PHP\Projects\blueTube_(3-100)\public\storage\img\middlw.PNG");
    echo $cont;
});


Route::get("/plural", function () {
    // return "apple";
    $mango = new Fruit();
    $ro = new ReflectionObject($mango);

    print_r($ro);
});

// event test
Route::get("eve", function () {
    echo "eve";
    event(new testEvent("eve"));
});


Route::get("collection", function () {
    $collections = Collection::wrap(["apple", "mango", "kiwi", "peach", "banana", "orange"]);
    // event(new testEvent("eve"));

    echo $collections->shuffle();
});


Route::get("classTest", "testClassController@tc");


Route::get("hasMany", function() {

});

Route::get("freeFacebook", function() {

});




Route::get("giveMeRandom", function () {
    $arr = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'];
    function giveMeRandom($arr = [], $size = 0)
    {
        $tmp = [];
        $items = count($arr);

        for ($i = 0; $i < $size; $i++) {
            $tmp[] = $arr[rand(0, $items - 1)];
        }
        return $tmp;
    }

    return giveMeRandom($arr, 100);
});


Route::get("debug", function(){
    return Collection::wrap(["a","b","c"])->map(function($e){
        return ucfirst($e);
    })->__toString();
});


Route::get("reordersection", function(){
    Section::all()->each(function($section, $i){
        echo "$i <br>";
        $section->update([
            "position" => $section->id
        ]);
    });

});

Route::get("whereHas", function(){
    $users = Video::whereWith("users", function($query){
        // $query->where(1,">=",1);
    });

    echo json_encode($users);
});

Route::get('/fruit', function () {
    dd( app()->make( "fruit" ));
});



//
