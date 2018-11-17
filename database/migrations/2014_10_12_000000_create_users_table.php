<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username', 100)->unique();
            $table->string('email',100)->unique();
            $table->string('password');
            $table->integer('university_id')->default(0);
            $table->foreign('university_id')->references('id')->on('university');
            $table->integer('registration_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->integer('is_admin')->default(0);
            $table->integer('points')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
