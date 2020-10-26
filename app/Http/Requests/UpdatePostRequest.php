<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class UpdatePostRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = Post::$rules;
        $rules['title'] = $rules['title'].","."title".",".$this->route("post");
        
        if(isset($request->images)){    
            if(!$request->images[0] == null){
                $rules['images.*'] = "image | mimes:jpeg,png,jpg,gif";
            }
        }

        return $rules;
    }
}
