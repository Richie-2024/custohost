@extends('layouts.general')

@section('content')

<nav class="mb-6 flex items-center text-sm space-x-2">
    <a href="{{ url()->previous() }}" class="text-blue-400 hover:text-blue-600 transition-colors">Back</a>
    <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
    <a href="{{ route('hostels.index') }}" class="text-blue-700 hover:text-blue-600 transition-colors">Book Room</a>
</nav>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

           

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="student_id" value="{{ Auth::id() }}">
            <input type="hidden" name="hostel_id" value="{{ $hostel->id }}">
            @if(request('room_id'))
                <input type="hidden" name="room_id" value="{{ request('room_id') }}">
            @endif

            <input type="hidden" name="redirect_route" value={{ Route::currentRouteName() }}>

            {{-- Booking Header --}}
            {{-- Booking Details --}}
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                    <i data-lucide="clipboard-list" class="h-5 w-5 text-gray-500"></i>
                    Booking Details
                </h3>

                @if(!request('room_id'))
                    <div class="mb-6">
                        <label for="room_id" class="block text-sm font-medium text-gray-700 mb-1">Select Room</label>
                        <select name="room_id" id="room_id"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required>
                            <option value="">Choose a room</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}"
                                        data-price="{{ $room->price }}"
                                        {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    Room {{ $room->room_number }} - {{ ucfirst($room->type) }} (UGX{{ number_format($room->price, 2) }}/month)
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="mb-6 bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="bg-blue-100 rounded-lg p-3">
                                    <i data-lucide="bed" class="h-5 w-5 text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Room {{ $rooms->first()->room_number }}</h4>
                                    <p class="text-sm text-gray-500">{{ ucfirst($rooms->first()->type) }} Room</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-semibold text-gray-900">UGX{{ number_format($rooms->first()->price, 2) }}</p>
                                <p class="text-sm text-gray-500">per month</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Check-in, Check-out, Special Requests --}}
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="check_in_date" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                        <input type="date" name="check_in_date" id="check_in_date"
                               value="{{ old('check_in_date') }}"
                               min="{{ date('Y-m-d') }}"
                               class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               required>
                        @error('check_in_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="check_out_date" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                        <input type="date" name="check_out_date" id="check_out_date"
                               value="{{ old('check_out_date') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               required>
                        @error('check_out_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests</label>
                        <textarea name="special_requests" id="special_requests" rows="3"
                                  class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('special_requests') }}</textarea>
                        @error('special_requests')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Price Summary --}}
            {{-- <div class="p-6 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i data-lucide="receipt" class="h-5 w-5 text-gray-500"></i>
                    Price Summary
                </h3>

                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Room Rate (per month)</span>
                            <span class="text-gray-900 font-medium">UGX<span id="room-rate">0.00</span></span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Duration</span>
                            <span class="text-gray-900 font-medium"><span id="duration">0</span> months</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 flex items-center justify-between">
                            <span class="text-gray-900 font-medium">Total Amount</span>
                            <span class="text-lg text-gray-900 font-semibold">UGX<span id="total-amount">0.00</span></span>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- Form Actions --}}
            <div class="px-6 py-4 bg-gray-50 flex items-center justify-end gap-4">
                <a href="{{ url()->previous() }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i data-lucide="arrow-left" class="h-4 w-4 mr-2"></i> Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i data-lucide="check-circle" class="h-4 w-4 mr-2"></i> Confirm Booking
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    // Initialize icons and setup price calculation
    lucide.createIcons();

    const roomSelect = document.getElementById('room_id');
    const checkIn = document.getElementById('check_in_date');
    const checkOut = document.getElementById('check_out_date');
    const roomRate = document.getElementById('room-rate');
    const durationEl = document.getElementById('duration');
    const totalEl = document.getElementById('total-amount');

    function updatePriceSummary() {
        const selectedOpt = roomSelect ? roomSelect.options[roomSelect.selectedIndex] : null;
        const price = selectedOpt ? parseFloat(selectedOpt.dataset.price) : {{ $rooms->first()->price ?? 0 }};
        roomRate.textContent = price.toFixed(2);

        if (checkIn.value && checkOut.value) {
            const start = new Date(checkIn.value);
            const end = new Date(checkOut.value);
            if (end <= start) {
                durationEl.textContent = 0;
                totalEl.textContent = '0.00';
                return;
            }
            const days = (end - start) / (1000 * 60 * 60 * 24);
            const months = Math.max(1, Math.ceil(days / 30));
            durationEl.textContent = months;
            totalEl.textContent = (price * months).toFixed(2);
        }
    }

    // Attach listeners and initialize
    if (roomSelect) roomSelect.addEventListener('change', updatePriceSummary);
    checkIn.addEventListener('change', updatePriceSummary);
    checkOut.addEventListener('change', updatePriceSummary);
    updatePriceSummary();
</script>
@endsection
