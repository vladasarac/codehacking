<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostsCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
	 
	// lekcija: 28 - Application - 223.Creating form part 2.mp4
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
	 
	// lekcija: 28 - Application - 223.Creating form part 2.mp4
    public function rules(){
        return [
		  // 'title'=>'required',
          // 'category_id'=>'required',
		  // 'photo_id'=>'required',
		  // 'body'=>'required'
        ];
    }
}





















