<?php

namespace App;
use App\Video;
use App\section;
use App\Comment;
use App\Favorite;
use App\History;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name',
    //     'username',
    //     'email',
    //     'password',
    //     'age',
    //     'gender',
    //     'profilepic'
    // ];

    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class, "creator");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function getAllUserIds()
    {
        $ids = [];
        $allId = $this->all();
        foreach ($allId as $id) {
            $ids[] = $id->id;
        }
        return $ids;
    }

    public static function getAllUserIdsArray()
    {
        return User::all()->pluck("id")->toArray();
    }

    public function getJoinedAttribute()
    {
        if ($this->created_at) {
            return $this->created_at->diffForHumans();
        } else {
            return "";
        }
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function views()
    {
        return $this->hasMany(History::class);
    }

}
