<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'hostel_id' => 'required|exists:hostels,id',
            'room_number' => 'required|string|max:50',
            'type' => 'required|in:single,double,triple,quad',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,occupied,maintenance',
            'description' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string',
        ];

        // Add unique validation for room number within hostel
        if ($this->isMethod('post')) {
            $rules['room_number'] .= '|unique:rooms,room_number,NULL,id,hostel_id,' . $this->hostel_id;
        } else {
            $rules['room_number'] .= '|unique:rooms,room_number,' . $this->room . ',id,hostel_id,' . $this->hostel_id;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'room_number.required' => 'The room number is required.',
            'room_number.unique' => 'This room number already exists in this hostel.',
            'type.required' => 'Please select a room type.',
            'type.in' => 'Invalid room type selected.',
            'capacity.required' => 'Please specify the room capacity.',
            'price.required' => 'The room price is required.',
            'price.min' => 'The price cannot be negative.',
        ];
    }
}