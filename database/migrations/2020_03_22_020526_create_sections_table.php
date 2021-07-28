<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("slug")->nullable();
            $table->string("description")->nullable();
            // $table->json("videos")->nullable();
            $table->unsignedBigInteger("creator")->nullable();
            $table->integer("position");
            $table->integer("locked")->dafault(0);
            $table->timestamps();

            $table->foreign('creator')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
