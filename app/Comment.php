<?php

namespace App;

use App\User;
use App\Video;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $guarded = [];


    // public function getCreatedAtAttribute()
    // {
    //     return $this->created_at->diffForHumans();
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
