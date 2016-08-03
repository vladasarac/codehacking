<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 
	// dodavanje kolone photo_id u users tabelu lekcija: 27 - Application - 200.Adding upload file feature to form.mp4
    public function up(){
        Schema::table('users', function (Blueprint $table) {
          $table->string('photo_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('photo_id');
        });
    }
}























