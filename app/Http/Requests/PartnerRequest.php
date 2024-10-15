<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'description'=>'required',
            'website'=>'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Your must enter the title',
            'description.required'=>'Your must enter the description',
            'website.required'=>'Your must insert the website link',
            'logo.required'=>'Your must insert a partner image',
        ];
    }
}
