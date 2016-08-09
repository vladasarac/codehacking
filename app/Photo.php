<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


// lekcija: 27 - Application - 202.User photos migration - relation - mass-assignment.mp4
class Photo extends Model{

  protected $uploads = '/images/'; // lekcija: 27 - Application - 206.Displaying photos using an accessor.mp4, ovo ce se konkatenirati na string izvucen iz file kolone 'photos' tabele da bi bila potpuna putanja ka slici u folderu 'codehacking\public\images'
  
  protected $fillable = ['file'];
  
  // metod koji radi konkatenaciju '/images/' na ime slike koje je u 'file' koloni 'photos' tabele da to nebi radili u vjuu vec da ovako stigne u vju
  public function getFileAttribute($photo){
    return $this->uploads . $photo;
  }
}
























