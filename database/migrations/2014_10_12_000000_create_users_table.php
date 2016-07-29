<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 
	//  lekcija: 27 - Application - 183.Users table Migration.mp4
    public function up(){
      Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
		$table->integer('role_id')->index()->unsigned()->nullable(); // dodato, userova rola(uloga)
		$table->integer('is_active')->default(0); // dodato, da li je user aktivan, po difoltu nije posto je 0
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
      Schema::drop('users');
    }
}




























