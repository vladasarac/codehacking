<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 
	// lekcija: 28 - Application - 228.Creating model and migration for categories.mp4
    public function up(){
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name'); // dodata kolona za ime kategorije
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('categories');
    }
}



























