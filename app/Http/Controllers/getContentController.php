<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;
use Illuminate\Support\Facades\DB;

class getContentController extends Controller
{
    // this function will return the list of recommended videos
    public function getRecommendedVideos()
    {
        $allvideos = DB::select("select * from videos");

        echo json_encode($allvideos);
    }
}
