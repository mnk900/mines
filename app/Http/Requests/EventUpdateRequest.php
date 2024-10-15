<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'eventName' => 'required|string|max:255',
            'eventDescription' => 'required|string',
            'eventDate' => 'required|date',
            'eventTime' => 'nullable',
            'eventLocation' => 'nullable|string|max:255',
            'eventOrganizer' => 'nullable|string|max:255',
            'eventImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'eventURL' => 'nullable|url',
            'ticketPrice' => 'nullable|numeric',
            'availableSeats' => 'nullable|integer',
            'eventCategory' => 'nullable|string|max:100',
            'eventTags' => 'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'EventName.required'=>'Your must enter the title',
            'EventDescription.required'=>'Your must enter the description'
        ];
    }
}
