<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateUserRequest extends FormRequest
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
        $rules = User::$rules;
        
        if($request['password'] == null){
            $rules['password'] = 'nullable';
        }
        $rules['email'] = $rules['email'].","."email".",".$this->route("user");
        return $rules;
    }
}
