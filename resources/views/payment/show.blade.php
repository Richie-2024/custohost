{{-- resources/views/payments/paynow.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight mt-0">
            {{ __('Complete Your Payment') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-500 to-teal-400 p-4">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Complete Your Payment</h2>
            
            <form action="{{ route('payment.initiate') }}" method="POST">
                @csrf
                <input type="hidden" name="hostel_id" value="{{ $booking->hostel->id }}">
                <input type="hidden" name="room_id" value="{{ $booking->room->id }}">
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="amount" value="{{ $booking->total_amount }}">
                <input type="hidden" name="payment_method" value="flutterwave">
            
                <!-- Total Amount -->
                <div class="mb-6">
                    <p class="text-lg font-medium text-gray-600">Total Amount Due:</p>
                    <p class="text-2xl font-bold text-teal-600">Ugx: {{ number_format($booking->total_amount, 2) }}</p>
                </div>
            
                <!-- Installment Input -->
                <div class="mb-6">
                    <label for="installment" class="text-lg font-medium text-gray-600">Enter Payment Amount:</label>
                    <input 
                        type="number" 
                        id="installment" 
                        name="installment" 
                        value="{{ old('installment') }}" 
                        class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" 
                        placeholder="Enter amount for installment payment"
                        min="0" 
                        max="{{ $booking->total_amount }}"
                    >
                    @error('installment')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Phone Number Input -->
                <div class="mb-6">
                    <label for="phone" class="text-lg font-medium text-gray-600">Phone Number:</label>
                    <input 
                        type="text" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone', auth()->user()->phone) }}" 
                        class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" 
                        placeholder="Enter your phone number"
                        required
                    >
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="w-full py-3 px-6 bg-teal-500 text-white font-semibold rounded-lg hover:bg-teal-600 transition duration-300">
                        Proceed to Pay
                    </button>
                </div>
            </form>
            

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">Secure Payment Powered by Flutterwave</p>
            </div>
        </div>
    </div>
</x-app-layout>
