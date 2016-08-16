<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{
  // lekcija: 28 - Application - 220.Displaying post.mp4
  protected $fillable = [
    'category_id',
	'photo_id',
	'title',
	'body'
  ];
  
  //  lekcija: 28 - Application - 221.Relationship setup.mp4
  public function user(){
    return $this->belongsTo('App\User'); //
  }
  public function photo(){
    return $this->belongsTo('App\Photo'); //
  }
  
  public function category(){
    return $this->belongsTo('App\Category'); //
  }
}






















