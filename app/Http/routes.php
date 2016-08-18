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
// URL : http://codehacking.dev/admin
Route::get('/admin', function(){
  return view('admin.index'); // ucitaj vju index.blade.php iz foldera 'codehacking\resources\views\admin' koji extenduje admin.blade.php iz foldera 'codehacking\resources\views\layouts'
});



// lekcija: 27 - Application - 212.Security  part 1 - middleware registration.mp4, napravljen je middleware Admin.php i u njega su ubacene rute koje idu ka AdminUsersControlleru
Route::group(['middleware'=>'admin'], function(){
  
  // lekcija: 27 - Application - 186.Admin controller and routes.mp4 , 
  Route::resource('admin/users', 'AdminUsersController');
  
  // lekcija: 28 - Application - Posts - 218.Setting route files.mp4
  Route::resource('admin/posts', 'AdminPostsController');
  
  // lekcija: 29 - Application - Categories - 238.Setting up categories.mp4
  Route::resource('admin/categories', 'AdminCategoriesController');

});























