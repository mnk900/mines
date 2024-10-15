<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreasOfWorkRequest extends FormRequest
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
            'title'=>'required',
            'description'=>'required',
            'tags'=>'required',
            'link'=>'required',
            'theme_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Your must enter the title',
            'description.required'=>'Your must enter the description',
            'tags.required'=>'Your must insert the tags',
            'link.required'=>'link is required',
            'theme_image.required'=>'Your must insert a theme image',
        ];
    }
}
