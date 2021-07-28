<?php

namespace App;
use App\User;
use App\History;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use App\Favorite;
use Illuminate\Support\Facades\Auth;


class Video extends Model
{
    //

    protected $guarded  = [];

    public function setSlugAttribute($title)
    {
        $this->attributes["slug"] = Str::slug($title);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getViewsAttribute()
    {
        $view = rand(0, 10000000);
        if ($view > 999999) {
            return round(($view / 100000), 2) . "M";
        }
        if ($view > 999) {
            return round(($view / 1000), 2) . "K";
        }
    }

    public function getIssavedAttribute()
    {
        $isSaved = Favorite::all()->where("video_id", "=", $this->id)->where("user_id", "=", Auth::user()->id)->count();
        return $isSaved;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likeCount()
    {
        $all =  $this->likes()->count();
        if ( !$all ) {
            return 50;
        }
        $likes = $this->likes()->where("type", "like")->count();
        return ($likes / $all) * 100;
    }

    public function dislikeCount()
    {
        $all = $this->likes()->count();
        $likes = $this->likes()->where("type", "like")->count();
        $dislikes = $all - $likes;
        return ($dislikes / $all) * 100;
    }


    public static function getAllVideoIdsArray()
    {
        $ids = [];
        $allId = self::all();
        foreach ($allId as $id) {
            $ids[] = $id->id;
        }
        return $ids;
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favoties()
    {
        return $this->hasMany(Favorite::class);
    }

    // public function video()
    // {
    //     return $this->hasMany(History::class);
    // }

}




//
