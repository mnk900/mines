<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewApplicationRequest extends FormRequest
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
            'firm_registration' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'deed_partnership' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'licence' => 'required',
            'name_mineral' => 'required',
            'location' => 'required',
            'covered_area' => 'required',
            'district' => 'required',
            'tehsil' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'firm_registration.required'=>'Type of Concession is required',
            'deed_partnership.required'=>'Firm/Company Form/MOA/Deed Partnership is required',
            'licence.required'=>'Type of Concession is required',
            'name_mineral.required'=>'Name of Mineral is required',
            'location.required'=>'Location is required',
            'covered_area.required'=>'Covered Area is required',
            'district.required'=>'District is required',
            'tehsil.required'=>'Tehsil is required',
        ];
    }
}
