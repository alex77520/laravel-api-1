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
	        $table->increments('id')->unsigned();
	        $table->string('open_id', 32);
	        $table->string('union_id', 32)->nullable();
	        $table->string('session_key', 50);
	        $table->string('nick_name', 50)->nullable();
	        $table->char('gender', 1)->nullable();
	        $table->string('language', 30)->nullable();
	        $table->string('city', 50)->nullable();
	        $table->string('province', 50)->nullable();
	        $table->string('country', 50)->nullable();
	        $table->string('avatar_url', 200)->nullable();
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
