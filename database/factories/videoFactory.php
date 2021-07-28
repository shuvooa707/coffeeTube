<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


$factory->define(Video::class, function (Faker $faker) {

    $allfiles = File::allFiles(public_path("storage/videos"));
    $allfiles = array_map(function ($file) {
        return $file->getFilename();
    }, $allfiles);

    $allthumb = File::allFiles(public_path("storage/thumbnail"));
    $allthumb = array_map(function ($file) {
        return "storage/thumbnail/" . $file->getFilename();
    }, $allthumb);

    $users = (new App\User)->getAllUserIds();
    $user = $users[rand(1, count($users) - 1)];

    $filepath = explode(".mp4", $allfiles[$faker->numberBetween(0, count($allfiles) - 1)])[0];
    $filename = $faker->text(100);

    return [
        "title" => $filename,
        "slug" => Str::slug($filename),
        "type" => ["natok","movie","telefilm"][rand(0,2)],
        "genre" => ["horror", "comedy", "drama", "documentry"][rand(0, 3)],
        "description" => $faker->text(100),
        "rating" => $faker->randomFloat(3,0,5),
        "length" => $faker->numberBetween(0,1000),
        "resolution" => ["120p", "240p", "420p", "380p", "720p", "1080p", "4k"][rand(0, 6)],
        "release_date" => $faker->date(),
        "director" => $faker->name(),
        "producer" => $faker->name(),
        "public" => "public",
        "videoPath" => "storage/videos/" . $filepath . ".mp4",
        "thumbnail" => $allthumb[$faker->numberBetween(0, count($allthumb) - 1)],
        "user_id" => $user
    ];
});
