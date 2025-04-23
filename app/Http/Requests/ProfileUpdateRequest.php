<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'phone' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'sex' => ['nullable', 'in:M,F'],
            'birthdate' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ];
    }

    public function messages()
    {
        return [
            'profile_image.max' => 'The profile image must not be larger than 2MB.',
            'profile_image.image' => 'The file must be an image.',
            'email.unique' => 'This email address is already taken.',
            'phone.unique' => 'This phone number is already taken.',
        ];
    }
}