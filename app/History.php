<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Video;

class History extends Model
{
    protected $guaded = [];



    public function getViewedAttribute()
    {
        if ($this->created_at) {
            return $this->created_at->diffForHumans();
        } else {
            return "";
        }
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function video()
    {
        return $this->hasOne(Video::class);
    }
}
