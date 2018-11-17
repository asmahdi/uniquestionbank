<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslatedPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translated_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('t_username', 100)->unique();
            $table->foreign('t_username')->references('username')->on('user');
            $table->integer('uploader_id');
            $table->foreign('uploader_id')->references('id')->on('user');
            $table->integer('post_id');
            $table->foreign('post_id')->references('id')->on('post');
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
        Schema::dropIfExists('translated_posts');
    }
}
