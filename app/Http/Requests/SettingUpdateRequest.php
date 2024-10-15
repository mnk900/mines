<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
        // Get the setting ID if it exists
        $setting = $this->route('setting');
        //dd($setting);
        return [
            'key' => 'required|max:255|unique:settings,key,' . $setting->id,
            'value'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'key.required'=>'Your must enter the title',
            'value.required'=>'Your must enter the description'
        ];
    }
}
