@extends('layouts.general')
@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="flex items-center justify-between p-6">
        <div class="flex items-center gap-3 ">
            <i class="bi bi-house-door text-gray-600 text-2xl"></i>
            <h2 class="text-2xl font-bold text-gray-800">
                Tenant Dashboard
            </h2>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <i class="bi bi-clock-history text-gray-400 text-base"></i>
                <span>Last updated: {{ now()->format('M d, Y h:i A') }}</span>
            </div>
            <button onclick="window.location.reload()" class="p-2 bg-white border border-gray-200 hover:bg-gray-100 rounded-full transition-colors">
                <i class="bi bi-arrow-clockwise text-gray-600 text-lg"></i>
            </button>
        </div>
    </div>
</div>



    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Current Booking Status -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">
            <div class="p-6">
                @if($activeBooking)
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2">
                            <i class="bi bi-check-circle-fill text-green-500 text-lg"></i>
                            <h3 class="text-xl font-bold text-gray-900">
                                Current Booking
                            </h3>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                            <i class="bi bi-circle-fill text-green-400 text-xs mr-2"></i> Active
                        </span>
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Hostel Card -->
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-blue-100 rounded-full p-3">
                                    <i class="bi bi-building text-blue-600 text-lg"></i>
                                </div>
                                <h4 class="text-md font-semibold text-gray-900">My Hostel</h4>
                            </div>
                            <p class="text-sm text-gray-800">{{ $activeBooking->hostel->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $activeBooking->hostel->address }}</p>
                        </div>
                        <!-- Browse Hostels Card -->
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-blue-100 rounded-full p-3">
                            <i class="bi bi-house-door-fill text-blue-600 text-lg"></i>
                        </div>
                        <h4 class="text-md font-semibold text-gray-900">Browse Hostels</h4>
                    </div>
                    <p class="text-sm text-gray-800">Discover a variety of hostels available near you.</p>
                    <p class="text-xs text-gray-500 mt-1">Explore affordable options, with convenient locations and great amenities.</p>
                    <a href="{{ route('hostels.browse') }}" class="mt-3 text-sm text-blue-600 hover:underline">View Available Hostels</a>
                </div>

                        <!-- Room Details Card -->
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-purple-100 rounded-full p-3">
                                    <i class="bi bi-door-open-fill text-purple-600 text-lg"></i>
                                </div>
                                <h4 class="text-md font-semibold text-gray-900">Room Details</h4>
                            </div>
                            <p class="text-sm text-gray-800">Room {{ $activeBooking->room->room_number ?? "Null" }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ ucfirst($activeBooking->room->type) }} Room</p>
                        </div>
        
                        <!-- Duration Card -->
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-green-100 rounded-full p-3">
                                    <i class="bi bi-calendar-event text-green-600 text-lg"></i>
                                </div>
                                <h4 class="text-md font-semibold text-gray-900">Duration</h4>
                            </div>
                            <p class="text-sm text-gray-800">
                                {{ $activeBooking->check_in_date->format('M d, Y') }} – {{ $activeBooking->check_out_date->format('M d, Y') }}
                            </p>
                            {{-- <p class="text-xs text-gray-500 mt-1">
                                {{ floor($activeBooking->check_in_date->diffInDays($activeBooking->check_out_date)) }} days
                            </p>
                             --}}
                        </div>
                    </div>
        
                @else
                    <div class="text-center py-12">
                        <div class="bg-gray-100 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-house-door text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No Active Booking</h3>
                        <p class="text-sm text-gray-500 mb-6">Get started by booking a room in one of our hostels.</p>
                        <a href="{{ route('hostels.browse') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2.5 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition shadow-sm">
                            <i class="bi bi-search text-white text-base"></i>
                            Browse Hostels
                        </a>
                    </div>
                @endif
            </div>
        </div>
        

        <!-- Booking History -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <i data-lucide="history" class="h-5 w-5 text-gray-500"></i>
                        Booking History
                    </h3>
                </div>
        
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-house-door text-gray-400"></i>
                                        Hostel
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-door-open text-gray-400"></i>
                                        Room
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-calendar text-gray-400"></i>
                                        Duration
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-cash-coin text-gray-400"></i>
                                        Amount
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-check2-circle text-gray-400"></i>
                                        Status
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="bg-gray-100 rounded-lg p-2 mr-3">
                                                <!-- Bootstrap building icon -->
                                                <i class="bi bi-building h-5 w-5 text-gray-500"></i>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $booking->hostel?->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </td>
                        
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            Room {{ $booking->room?->room_number ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ ucfirst($booking->room?->type ?? 'N/A') }}
                                        </div>
                                    </td>
                        
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $booking->check_in_date?->format('M d') ?? 'N/A' }} - 
                                            {{ $booking->check_out_date?->format('M d, Y') ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->check_in_date && $booking->check_out_date 
                                                ? $booking->check_in_date->diffInDays($booking->check_out_date) . ' days' 
                                                : 'N/A' }}
                                        </div>
                                    </td>
                        
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            UGX{{ number_format($booking->total_amount ?? 0, 2) }}
                                        </div>
                                    </td>
                        
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $booking->status === 'completed' ? 'bg-success text-success' : 
                                               ($booking->status === 'active' ? 'bg-primary text-primary' : 
                                               ($booking->status === 'cancelled' ? 'bg-danger text-danger' : 'bg-warning text-warning')) }}">
                                            <!-- Bootstrap circle icon -->
                                            <i class="bi bi-circle h-2 w-2 mr-1"></i>
                                            {{ ucfirst($booking->status ?? 'N/A') }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center py-4">
                                            <!-- Bootstrap calendar-x icon -->
                                            <i class="bi bi-calendar-x h-8 w-8 text-gray-400 mb-2"></i>
                                            No booking history found
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
        

        <!-- Payment Status -->
        @if($activeBooking)
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6">
            <div class="p-6">
                <div class="flex items-center gap-2 mb-6">
                    <i class="bi bi-credit-card text-purple-500 text-xl"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Payment Status</h3>
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-green-100 rounded-lg p-2">
                                <i class="bi bi-wallet2 text-green-600 text-lg"></i>
                            </div>
                            <h4 class="text-sm font-medium text-gray-900">Total Amount</h4>
                        </div>
                        <p class="text-lg font-semibold text-gray-900">
                            UGX{{ number_format($activeBooking->total_amount, 2) }}
                        </p>
                    </div>
    
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-blue-100 rounded-lg p-2">
                                <i class="bi bi-check-circle text-blue-600 text-lg"></i>
                            </div>
                            <h4 class="text-sm font-medium text-gray-900">Payment Status</h4>
                        </div>
    
                        @if($pendingPayments->count() > 0)
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="bi bi-exclamation-circle-fill mr-1 text-yellow-800"></i>
                                    Payment Pending
                                </span>
                                <a href="{{ route('payments.booking.create', $activeBooking->id) }}"
                                   class="flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-700">
                                    Make Payment
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="bi bi-check-circle-fill mr-1 text-green-800"></i>
                                Fully Paid
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    </div>
@endsection