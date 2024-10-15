<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'page_link'=>'required',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Your must enter the title',
            'description.required'=>'Your must enter the description',
            'page_link.required'=>'Your must select a page link',
            'slider_image.required'=>'Your must insert a slider image',
        ];
    }
}
