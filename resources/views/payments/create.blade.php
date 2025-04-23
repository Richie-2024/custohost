@extends('layouts.general')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Navigation -->
    <nav class="mb-6 flex items-center text-sm space-x-2">
        <a href="{{ route('payments.index') }}" class="text-blue-400 hover:text-blue-600 transition-colors">
            Back to Payments
        </a>
        <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
        <span class="text-blue-700">Record Payment</span>
    </nav>

    <!-- Create Payment Form -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="bi bi-credit-card text-blue-600 text-xl"></i>
                </div>
                <h1 class="text-xl font-semibold text-gray-900">Record New Payment</h1>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
            <div class="bg-red-100 text-red-600 px-4 py-3 rounded-md mb-4">
                <strong>Error(s):</strong>
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('payments.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Booking Selection -->
                <div class="space-y-2">
                    <label for="booking_id" class="block text-sm font-medium text-gray-700">
                        Select Booking
                    </label>
                    <select name="booking_id" id="booking_id" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select a booking</option>
                        @foreach($bookings as $booking)
                        <option value="{{ $booking->id }}" data-hostel-id="{{ optional($booking->hostel)->id }}">
                            Room {{ optional($booking->room)->room_number ?? 'Unknown Room' }} -
                            {{ optional($booking->student)->name ?? 'Unknown Student' }} 
                            ({{ optional($booking->check_in_date)->format('M d, Y') ?? 'N/A' }} to 
                            {{ optional($booking->check_out_date)->format('M d, Y') ?? 'N/A' }})
                        </option>
                        @endforeach
                    </select>
                    @error('booking_id')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hidden Hostel ID -->
                <input type="hidden" name="hostel_id" id="hostel_id" value="">

                <!-- JavaScript to Capture Hostel ID -->
                <script>
                    document.getElementById('booking_id').addEventListener('change', function() {
                        var selectedOption = this.options[this.selectedIndex];
                        document.getElementById('hostel_id').value = selectedOption.getAttribute('data-hostel-id') || '';
                    });
                </script>

                <!-- Amount -->
                <div class="space-y-2">
                    <label for="amount" class="block text-sm font-medium text-gray-700">
                        Payment Amount (UGX)
                    </label>
                    <input type="number" name="amount" id="amount" required min="1"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Enter amount">
                    @error('amount')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Method -->
                <div class="space-y-2">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">
                        Payment Method
                    </label>
                    <select name="payment_method" id="payment_method" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select payment method</option>
                        <option value="cash">Cash</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="mobile_money">Mobile Money</option>
                    </select>
                    @error('payment_method')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reference Number -->
                <div class="space-y-2">
                    <label for="reference_number" class="block text-sm font-medium text-gray-700">
                        Reference Number (Optional)
                    </label>
                    <input type="text" name="reference_number" id="reference_number"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Enter reference number">
                    @error('reference_number')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Payment Date -->
              <div class="space-y-2">
                <label for="payment_date" class="block text-sm font-medium text-gray-700">
                    Payment Date
                </label>
                <input type="date" name="payment_date" id="payment_date" required
                      class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('payment_date')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>


                <!-- Notes -->
                <div class="space-y-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700">
                        Notes (Optional)
                    </label>
                    <textarea name="notes" id="notes" rows="3"
                              class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                              placeholder="Add any additional notes"></textarea>
                    @error('notes')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                        <i class="bi bi-check-lg mr-2"></i>
                        Record Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
