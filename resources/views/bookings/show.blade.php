@extends('layouts.general')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">

    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-6 bg-white sm:rounded-xl sm:shadow-sm sm:border sm:p-6 p-4">
        
        {{-- Title --}}
        <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
            <i class="bi bi-calendar-check h-6 w-6 text-gray-600"></i>
            Booking #{{ $booking->id }}
        </h2>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 w-full sm:w-auto">
            
            {{-- Edit Button --}}
            <a href="#"
               class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm w-full sm:w-auto">
                <i class="bi bi-pencil-square mr-2"></i> Edit Booking
            </a>

            {{-- Delete Form --}}
            <form action="{{ route('bookings.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to Cancel this booking?');" class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700 shadow-sm w-full sm:w-auto">
                    <i class="bi bi-trash-fill mr-2"></i> Delete Booking
                </button>
            </form>

        </div>
    </div>

</div>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left (Main Details) --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Booking Details --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                    <i class="bi bi-info-circle text-gray-500"></i> Booking Details
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Check-in --}}
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Check-in Date</h4>
                        <p class="mt-2 text-sm text-gray-900">{{ $booking->check_in_date->format('M d, Y') }}</p>
                    </div>

                    {{-- Check-out --}}
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Check-out Date</h4>
                        <p class="mt-2 text-sm text-gray-900">{{ $booking->check_out_date->format('M d, Y') }}</p>
                    </div>

                    {{-- Duration --}}
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Duration</h4>
                        <p class="mt-2 text-sm text-gray-900">
                            {{ rtrim(number_format($booking->check_in_date->diffInHours($booking->check_out_date) / 24, 3), '0.') }} days
                        </p>
                    </div>

                    {{-- Status --}}
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Status</h4>
                        <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $booking->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                </div>
            </div>

            {{-- Student Details --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                    <i class="bi bi-person text-gray-500"></i> Student Details
                </h3>

                <div class="flex items-center gap-4">
                    
                    {{-- Avatar --}}
                    <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                        <i class="bi bi-person-fill text-gray-500"></i>
                    </div>

                    {{-- Info --}}
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">{{ $booking->student->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $booking->student->email }}</p>
                        <p class="text-sm text-gray-500">{{ $booking->student->phone }}</p>
                    </div>

                </div>
            </div>

        </div>

        {{-- Right Sidebar --}}
        <div class="space-y-6">

            {{-- Room Info --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i class="bi bi-door-open text-gray-500"></i> Room Info
                </h3>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Room Number</h4>
                    <p class="mt-2 text-sm text-gray-900">{{ $booking->room->room_number }}</p>
                </div>

                <div class="mt-4">
                    <h4 class="text-sm font-medium text-gray-500">Room Type</h4>
                    <p class="mt-2 text-sm text-gray-900">{{ ucfirst($booking->room->type) }}</p>
                </div>

                <div class="mt-4">
                    <h4 class="text-sm font-medium text-gray-500">Price per Month</h4>
                    <p class="mt-2 text-sm text-gray-900">UGX {{ number_format($booking->room->price, 2) }}</p>
                </div>
            </div>

            {{-- Hostel Info --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i class="bi bi-building text-gray-500"></i> Hostel Info
                </h3>

                <div class="flex items-center gap-4">
                    
                    {{-- Hostel Photo --}}
                    @if($booking->room->hostel->photo)
                        <img src="{{ Storage::url($booking->room->hostel->photo) }}" 
                             alt="{{ $booking->room->hostel->name }}"
                             class="h-16 w-16 rounded-lg object-cover">
                    @else
                        <div class="h-16 w-16 rounded-lg bg-gray-100 flex items-center justify-center">
                            <i class="bi bi-building text-gray-400 h-8 w-8"></i>
                        </div>
                    @endif

                    {{-- Hostel Info --}}
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">{{ $booking->room->hostel->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $booking->room->hostel->address }}</p>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
@endsection
