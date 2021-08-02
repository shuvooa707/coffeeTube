<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('slug')->unique()->nullable();
            $table->string('type');
            $table->string('genre')->nullable();
            $table->string("description");
            $table->string("director")->nullable();
            $table->string("producer")->nullable();
            $table->float('rating')->default(3.5);
            $table->float('length')->nullable();
            $table->string('resolution')->nullable();
            $table->date("release_date")->nullable();
            $table->string("public")->default("public");

            $table->string("videoPath");
            $table->string("thumbnail");

            $table->unsignedBigInteger("user_id");


            // $table->foreign("comment_id")->references("id")->on("comments")->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
