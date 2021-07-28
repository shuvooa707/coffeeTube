<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;
use App\User;
use App\Video;


$factory->define(Comment::class, function (Faker $faker) {
    $users = User:: getAllUserIdsArray();
    $user = $users[ rand(1, count($users))-1 ];

    $videos = Video::getAllVideoIdsArray();
    $video = $videos[rand(1, count($videos))-1 ];

    return [
        "content" => $faker->text(rand(100,100)),
        "user_id" => $user,
        "video_id" => $video,
        "read" => ["read", "unread"][rand(0,1)]
    ];
});
