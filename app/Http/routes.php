<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

// lekcija: 27 - Application - 190.Admin master file - download file.mp4
Route::get('/admin', function(){
  return view('admin.index'); // ucitaj vju index.blade.php iz foldera 'codehacking\resources\views\admin' koji extenduje admin.blade.php iz foldera 'codehacking\resources\views\layouts'
});

// lekcija: 27 - Application - 186.Admin controller and routes.mp4
Route::resource('admin/users', 'AdminUsersController');

























