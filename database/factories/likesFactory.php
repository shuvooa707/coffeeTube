<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use App\Model;
use App\User;
use App\Video;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        "type" => ["like","dislike"][rand(0,1)],
        "user_id" => User::pluck("id")[$faker->numberBetween(1,User::pluck("id")->count()-1)],
        "video_id" => Video::pluck("id")[$faker->numberBetween(1,Video::pluck("id")->count()-1)]
    ];
});
