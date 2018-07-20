<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('course_id');
            $table->foreign('course_id')->references('id')->on('course');
            $table->string('description',1000);
            $table->integer('status_code');
            $table->string('url');
            $table->integer('uploader_id');
            $table->foreign('uploader_id')->references('id')->on('user');
            $table->integer('category_id');
            $table->foreign('category_id')->references('id')->on('category');
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
        Schema::dropIfExists('post');
    }
}
