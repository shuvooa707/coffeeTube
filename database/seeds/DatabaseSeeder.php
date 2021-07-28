<?php

use App\Comment;
use App\Like;
use App\section;
use App\User;
use App\Video;
// use App\likeDislike;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     userSeeder::class
        // ]);
        // factory(App\Video::class, 100)->create()->each(function ($x) {
        //     echo $x;
        // });

        // factory(App\User::class, 100)->create()->each(function ($x) {
        //     echo $x;
        // });

        DB::table("comments")->delete();
        DB::table("videos")->delete();
        DB::table("sections")->delete();
        DB::table("users")->delete();
        DB::table("likes")->delete();

        factory(User::class,100)->create()->each(function($user){});
        factory(Video::class,100)->create();
        factory(section::class, 100)->create();
        factory(Comment::class, 100)->create();
        factory(Like::class, 100)->create();


        User::create([
            "name" => "Shuvo Sarker",
            "username" => "shuvo",
            "gender" => "male",
            "age" => 25,
            "role" => "admin",
            "email" => "shuvo@gm.com",
            "password" => bcrypt("shuvo")
        ]);


        Section::all()->each(function($section){
            $videoids = Video::pluck("id")->toArray();

            $section->videos()->sync(
                array_splice($videoids, rand(0, count($videoids)), rand(0, count($videoids)))
            );
        });

    }
}
