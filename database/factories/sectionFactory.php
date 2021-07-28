<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\section;
use Faker\Generator as Faker;

$position = 0;
$factory->define(section::class, function (Faker $faker) {
    $users = (new App\User)->getAllUserIds();
    $user = $users[rand(1, count($users) - 1)];
    global $position;
    echo $position . "\n";
    return [
        "name" => $faker->text(50),
        "slug" => $faker->slug(),
        "locked" => 1,
        "description" => $faker->realText(),
        "position" => $position++,
        "creator" => $user,
    ];
});
