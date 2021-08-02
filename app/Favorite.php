<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Video;

    class Favorite extends Model
{

    protected $guarded = [];


    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function video()
    {
        return $this->hasOne(Video::class);
    }
}
