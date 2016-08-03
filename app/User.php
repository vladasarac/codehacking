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
	
}


























