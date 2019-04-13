<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
    public function rules()
    {
        return [
            //
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'.Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80',
        ];
    }

    public function messages()
    {
        return [
            // 'name.unique' => 'Username has been used.',
            // 'name.regex' => 'Username can only contain letters, numbers, crossbars and underscores.',
            // 'name.between' => 'Username must be between 3 and 25 characters。',
            // 'name.required' => 'Username is required.',
            /*'email.email' => 'Enter the correct email address format',
            'email.required' => 'Email is required'*/
        ];
    }
}
