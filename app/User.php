<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'photo_id', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	// lekcija: 27 - Application - 184.Relation setup and data entry.mp4
	public function role(){
	  return $this->belongsTo('App\Role');
	}
	
	// lekcija: 27 - Application - 202.User photos migration - relation - mass-assignment.mp4
	public function photo(){
	  return $this->belongsTo('App\Photo');
	}
	
	// lekcija: 27 - Application - 213.Security part 2 - middleware - custom method and 404 page.mp4
	public function isAdmin(){
	  if($this->role->name == "administrator" && $this->is_active == 1){ // ako je user administrator i aktivan je tj kolona is_active == 1 onda vrati true
	    return true;
	  }
	  return false; // ako nije administrator vrati false
	}
	
	// lekcija: 28 - Application - 221.Relationship setup.mp4
	public function posts(){
	  return $this->hasMany('App\Post'); // one-to-many relacija izmedu usera i postova (jedan user moze imati vise postova)
	}
}


























