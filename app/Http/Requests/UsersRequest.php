<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
	 
	// lekcija: 27 - Application - 198.Password field and custom request.mp4
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
	// lekcija: 27 - Application - 198.Password field and custom request.mp4
	// ovde radi validaciju unosa u formu u create.blade.php za kreiranje novog usera
    public function rules(){
        return [
          'name'=>'required',
		  'email'=>'required',
		  'role_id'=>'required',
		  'is_active'=>'required',
		  'password'=>'required'
        ];
    }
}



























