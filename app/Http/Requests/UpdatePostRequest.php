<?php

namespace App\Http\Requests;

class UpdatePostRequest extends StorePostRequest
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
            'slug'=>'required',
            'body'=>'required',
            'excerpt'=>'required',
            'published'=>'nullable|date_format:Y-m-d H:i:s',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

}
