<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'booking_id' => 'required|exists:bookings,id',
            'hostel_id' => 'required|exists:hostels,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,card,bank_transfer',
            'payment_date' => 'required|date',
            'transaction_id' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'The payment amount is required.',
            'amount.min' => 'The payment amount cannot be negative.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'Invalid payment method selected.',
            'payment_date.required' => 'The payment date is required.',
        ];
    }
}