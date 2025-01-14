<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'content'=>'required',
            'url'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Your must enter the title',
            'content.required'=>'Your must enter the content',
            'url.required'=>'Your must enter the url'
        ];
    }
}
