<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use App\sections\SectionManager;
use App\section;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($arg=0)
    {
        return dd("apple");
    }
    public function show()
    {
        // Debugbar::info();
        
        $mostPopular = Video::all();
        $topTrending = Video::all();
        $upperSlider = Video::all();
        $topFiveSections = Section::paginate(5)->where("locked", "=", "0"); ;
        return view('home', [
            "user" => auth()->user(),
            "upperSlider" => $upperSlider,
            "mostPopular" => $mostPopular,
            "topTrending" => $topTrending,
            "topFiveSections" => $topFiveSections
        ]);
    }
}
