@extends('layouts.general')
@section('content')
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
                <i data-lucide="graduation-cap" class="h-6 w-6 text-gray-600"></i>
                Student Dashboard
            </h2>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Last updated: {{ now()->format('M d, Y h:i A') }}</span>
                <button onclick="window.location.reload()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <i data-lucide="refresh-cw" class="h-5 w-5 text-gray-500"></i>
                </button>
            </div>
        </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Current Booking Status -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6">
            <div class="p-6">
                @if($activeBooking)
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i data-lucide="check-circle" class="h-5 w-5 text-green-500"></i>
                            Current Booking
                        </h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i data-lucide="circle" class="h-3 w-3 mr-1"></i>
                            Active
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-blue-100 rounded-lg p-2">
                                    <i data-lucide="building" class="h-5 w-5 text-blue-600"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900">Hostel</h4>
                            </div>
                            <p class="text-sm text-gray-900">{{ $activeBooking->hostel->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $activeBooking->hostel->address }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-purple-100 rounded-lg p-2">
                                    <i data-lucide="door-open" class="h-5 w-5 text-purple-600"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900">Room Details</h4>
                            </div>
                            <p class="text-sm text-gray-900">Room {{ $activeBooking->room->room_number }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ ucfirst($activeBooking->room->type) }} Room</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-green-100 rounded-lg p-2">
                                    <i data-lucide="calendar" class="h-5 w-5 text-green-600"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900">Duration</h4>
                            </div>
                            <p class="text-sm text-gray-900">
                                {{ $activeBooking->check_in_date->format('M d, Y') }} - 
                                {{ $activeBooking->check_out_date->format('M d, Y') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $activeBooking->check_in_date->diffInDays($activeBooking->check_out_date) }} days
                            </p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-gray-100 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="home" class="h-8 w-8 text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Active Booking</h3>
                        <p class="text-sm text-gray-500 mb-6">Get started by booking a room in one of our hostels.</p>
                        <a href="{{ route('hostels.browse') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-sm">
                            <i data-lucide="search" class="h-4 w-4 mr-2"></i>
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
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="bg-gray-100 rounded-lg p-2 mr-3">
                                                <i data-lucide="building" class="h-5 w-5 text-gray-500"></i>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">{{ $booking->hostel->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Room {{ $booking->room->room_number }}</div>
                                        <div class="text-sm text-gray-500">{{ ucfirst($booking->room->type) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $booking->check_in_date->format('M d') }} - {{ $booking->check_out_date->format('M d, Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->check_in_date->diffInDays($booking->check_out_date) }} days
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">UGX{{ number_format($booking->total_amount, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $booking->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($booking->status === 'active' ? 'bg-blue-100 text-blue-800' : 
                                               ($booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                            <i data-lucide="circle" class="h-2 w-2 mr-1"></i>
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center py-4">
                                            <i data-lucide="calendar-x" class="h-8 w-8 text-gray-400 mb-2"></i>
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
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                        <i data-lucide="credit-card" class="h-5 w-5 text-purple-500"></i>
                        Payment Status
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-green-100 rounded-lg p-2">
                                    <i data-lucide="wallet" class="h-5 w-5 text-green-600"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900">Total Amount</h4>
                            </div>
                            <p class="text-lg font-semibold text-gray-900">UGX{{ number_format($activeBooking->total_amount, 2) }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-blue-100 rounded-lg p-2">
                                    <i data-lucide="check-circle" class="h-5 w-5 text-blue-600"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900">Payment Status</h4>
                            </div>
                            @if($pendingPayments->count() > 0)
                                <div class="flex items-center justify-between">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i data-lucide="alert-circle" class="h-3 w-3 mr-1"></i>
                                        Payment Pending
                                    </span>
                                    <a href="{{ route('payments.booking.create', $activeBooking->id) }}" 
                                       class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                                        Make Payment
                                        <i data-lucide="chevron-right" class="h-4 w-4"></i>
                                    </a>
                                </div>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i data-lucide="check-circle" class="h-3 w-3 mr-1"></i>
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