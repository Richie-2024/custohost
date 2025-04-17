<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hostel_id' => 'required|exists:hostels,id',
            'room_id' => 'required|exists:rooms,id',
            'student_id' => 'required|exists:users,id',
            'check_in_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'check_out_date' => [
                'required',
                'date',
                'after:check_in_date',
            ],
            'special_requests' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'check_in_date.after_or_equal' => 'Check-in date must be today or a future date.',
            'check_out_date.after' => 'Check-out date must be after check-in date.',
            'room_id.exists' => 'The selected room is invalid.',
            'student_id.exists' => 'The selected student is invalid.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'check_in_date' => Carbon::parse($this->check_in_date)->startOfDay(),
            'check_out_date' => Carbon::parse($this->check_out_date)->endOfDay(),
        ]);
    }
}