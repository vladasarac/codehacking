<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersEditRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
	 
	// lekcija: 27 - Application - 210.Updating part 2.mp4 vaklidacija za formu u edit.blade.php pri editovanju postojeceg usera
    public function authorize(){
      return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
          'name'=>'required',
		  'email'=>'required',
		  'role_id'=>'required',
		  'is_active'=>'required'
		  
        ];
    }
}





















