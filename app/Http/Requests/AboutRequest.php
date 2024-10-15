<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mission' => 'required|string',
            'vision' => 'required|string',
            'history' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Your must enter the title',
            'description.required'=>'Your must enter the description',
            'mission.required'=>'Your must enter the mission',
            'vision.required'=>'Your must enter the vision',
            'history.required'=>'Your must enter the history',
        ];
    }
}
