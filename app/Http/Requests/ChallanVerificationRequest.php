<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChallanVerificationRequest extends FormRequest
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
            'fee_amount_submitted'=>'required',
            'fee_submitted'=>'required',
            'fee_verify'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Your must enter the title',
            'description.required'=>'Your must enter the description',
            'tags.required'=>'Your must insert the tags',
            'link.required'=>'link is required',
        ];
    }
}
