<?php

namespace App;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class section extends Model
{
    protected $guarded = [];

    // public function videos($key="")
    // {
    //     $videos = json_decode($this->videos);
    //     // dd($videos->id);
    //     $videos = array_map(function($vid){
    //         return Video::find($vid);
    //     },$videos->id);
    //     // dd($videos);
    //     $videos = array_filter($videos,function($video){
    //         if ( isset($video) && $video->public == "public" ) {
    //             return true;
    //         }
    //         return false;
    //     });
    //     return $videos;
    // }

    public function videosids()
    {
        $this->videos();
    }

    public function time()
    {
        return $this->created_at->diffForHumans();
    }


    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = section::all()->count() + 1;
    }

    public function getSlugAttribute()
    {
        return $this->name;
    }

    public function getAllSectionVideoIds($sid = null)
    {
        $ids = [];
        $allId = $this->videos;
        foreach ($allId as $id) {
            $ids[] = $id->id;
        }
        return $ids;
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, "creator");
    }

    public function creator()
    {
        return User::find($this->creator);
    }
}
