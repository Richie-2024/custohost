<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HostelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,inactive,maintenance',
            'total_rooms' => 'required|integer|min:0',
            'available_rooms' => 'required|integer|min:0|lte:total_rooms',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The hostel name is required.',
            'address.required' => 'The hostel address is required.',
            'photo.image' => 'The uploaded file must be an image.',
            'photo.max' => 'The image size should not exceed 2MB.',
            'total_rooms.required' => 'Please specify the total number of rooms.',
            'available_rooms.lte' => 'Available rooms cannot exceed total rooms.',
        ];
    }
}