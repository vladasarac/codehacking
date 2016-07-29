<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 
	// lekcija: 27 - Application - 183.Users table Migration.mp4
    public function up(){
      Schema::create('roles', function (Blueprint $table) {
        $table->increments('id');
		$table->string('name'); // dodato, ime role tj uloge koja se dodeljuje useru
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
      Schema::drop('roles');
    }
}


























