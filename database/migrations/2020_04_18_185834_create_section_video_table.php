<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_video', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("video_id");
            $table->unsignedBigInteger("section_id");


            $table->foreign("video_id")->references("id")->on("videos")->onDelete("cascade");
            $table->foreign("section_id")->references("id")->on("sections")->onDelete("cascade");


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
        Schema::dropIfExists('section_video');
    }
}
