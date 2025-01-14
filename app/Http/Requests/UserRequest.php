<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|min:8|confirmed'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Your must enter the name',
            'email.required'=>'Your must enter the email',
            'password.required'=>'Your must enter the password'
        ];
    }
}
