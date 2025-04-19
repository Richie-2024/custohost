@php
dd(Route::currentRouteName());
@endphp
@hostel_manager
<nav class="mb-6 flex items-center text-sm space-x-2">
    <a href="{{url()->previous() }}" class="text-blue-400 hover:text-blue-600 transition-colors">Back</a>
    <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
    <a href="{{ route('hostels.index') }}" class="text-blue-700 hover:text-blue-600 transition-colors">Add Room.</a>
</nav>
@endhostel_manager



@extends('layouts.general')
@section('content')
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 leading-tight flex items-center gap-3">
                <i class="bi bi-speedometer2 text-gray-600 text-2xl"></i>
                Hostel Manager Dashboard
            </h2>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500">Last updated: {{ now()->format('M d, Y h:i A') }}</span>
                <button onclick="window.location.reload()" class="p-2 hover:bg-gray-100 rounded-full transition-colors flex items-center justify-center">
                    <i class="bi bi-arrow-clockwise text-gray-500 text-lg"></i>
                </button>
            </div>
        </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Hostels -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-md hover:shadow-lg transition-all">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 rounded-full p-3">
                            <i class="bi bi-building text-blue-700 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Hostels</p>
                            <p class="text-3xl font-extrabold text-gray-900">{{ $hostels->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <a href="{{ route('hostels.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-1">
                            View All
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        <span class="flex items-center text-green-600 font-medium">
                            <i class="bi bi-graph-up-arrow mr-1"></i>
                            Active
                        </span>
                    </div>
                </div>
            </div>
        
            <!-- Active Bookings -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-md hover:shadow-lg transition-all">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-100 rounded-full p-3">
                            <i class="bi bi-calendar-check text-green-700 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Active Bookings</p>
                            <p class="text-3xl font-extrabold text-gray-900">{{ $activeBookings->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <a href="{{ route('bookings.all') }}" class="text-green-600 hover:text-green-800 font-semibold flex items-center gap-1">
                            Manage Bookings
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        <span class="flex items-center text-green-600 font-medium">
                            <i class="bi bi-people-fill mr-1"></i>
                            Occupied
                        </span>
                    </div>
                </div>
            </div>
        
            <!-- Pending Bookings -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-md hover:shadow-lg transition-all">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-yellow-100 rounded-full p-3">
                            <i class="bi bi-clock-history text-yellow-700 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Pending Bookings</p>
                            <p class="text-3xl font-extrabold text-gray-900">{{ $pendingBookings->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <a href="{{ route('bookings.pending') }}" class="text-yellow-600 hover:text-yellow-800 font-semibold flex items-center gap-1">
                            Review Pending
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        <span class="flex items-center text-yellow-600 font-medium">
                            <i class="bi bi-exclamation-circle-fill mr-1"></i>
                            Needs Action
                        </span>
                    </div>
                </div>
            </div>
        
            <!-- Total Revenue -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-md hover:shadow-lg transition-all">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-purple-100 rounded-full p-3">
                            <i class="bi bi-wallet2 text-purple-700 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Revenue</p>
                            <p class="text-3xl font-extrabold text-gray-900">UGX{{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <a href="{{ route('payments.index') }}" class="text-purple-600 hover:text-purple-800 font-semibold flex items-center gap-1">
                            View Payments
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        <span class="flex items-center text-green-600 font-medium">
                            <i class="bi bi-graph-up-arrow mr-1"></i>
                            This Month
                        </span>
                    </div>
                </div>
            </div>
        </div>
        

       <!-- Recent Bookings & Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Bookings -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <i class="bi bi-list text-gray-500 text-xl"></i>
                        Recent Bookings
                    </h3>
                    <a href="{{ route('bookings.all') }}" class="text-sm text-primary hover:underline font-medium flex items-center gap-1">
                        View All
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
    
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Student</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Room</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Check In</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($activeBookings->take(5) as $booking)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                                <i class="bi bi-person text-gray-500"></i>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $booking->student->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->student->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Room {{ $booking->room->room_number }}</div>
                                        <div class="text-sm text-gray-500">{{ ucfirst($booking->room->type) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $booking->check_in_date->format('M d, Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->check_in_date->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $booking->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            <i class="bi bi-circle-fill {{ $booking->status === 'active' ? 'text-green-500' : 'text-yellow-500' }}" style="font-size: 0.5rem;"></i>
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center space-y-2">
                                            <i class="bi bi-inbox-fill text-gray-400 text-3xl"></i>
                                            <span>No recent bookings found</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Quick Actions -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i class="bi bi-lightning-charge-fill text-yellow-500"></i>
                    Quick Actions
                </h3>
                <div class="space-y-3">
                    <a href="{{route('hostels.create')}}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex items-center gap-3">
                            <div class="bg-blue-100 rounded-lg p-2">
                                <i class="bi bi-building-fill text-blue-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Add New Hostel</span>
                        </div>
                        <i class="bi bi-chevron-right text-gray-400"></i>
                    </a>

    
                    <a href="{{ route('bookings.pending') }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex items-center gap-3">
                            <div class="bg-yellow-100 rounded-lg p-2">
                                <i class="bi bi-clock-fill text-yellow-600"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Review Pending Bookings</span>
                        </div>
                        <i class="bi bi-chevron-right text-gray-400"></i>
                    </a>
                </div>
            </div>
        </div>
    

        <!-- Room Status -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i class="bi bi-house-fill text-indigo-500"></i>
                    Room Status
                </h3>
                <div class="space-y-4">
                    @foreach($hostels as $hostel)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="text-sm font-semibold text-gray-900 mb-3">{{ $hostel->name }}</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                    <span class="text-sm text-gray-600">{{ $hostel->available_rooms }} Available</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                                    <span class="text-sm text-gray-600">{{ $hostel->total_rooms - $hostel->available_rooms }} Occupied</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    
        <!-- Recent Payments -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i class="bi bi-credit-card-fill text-purple-500"></i>
                    Recent Payments
                </h3>
                <div class="space-y-6">
                    @forelse($hostels as $hostel)
                      <div>
                        <h2 class="text-lg font-semibold text-gray-800">{{ $hostel->name }}</h2> {{-- hostel name --}}
                        <div class="space-y-3 mt-2">
                          @forelse($hostel->payments()->latest()->take(5)->get() as $payment)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                              <div class="flex items-center gap-3">
                                <div class="bg-purple-100 rounded-lg p-2">
                                  <i class="bi {{ $payment->payment_method === 'card' ? 'bi-credit-card-fill' : ($payment->payment_method === 'cash' ? 'bi-cash' : 'bi-bank') }} text-purple-600"></i>
                                </div>
                                <div>
                                  <p class="text-sm font-medium text-gray-900">UGX{{ number_format($payment->amount, 2) }}</p>
                                  <p class="text-xs text-gray-500">{{ $payment->created_at->format('M d, Y') }}</p>
                                </div>
                              </div>
                              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $payment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                <i class="bi bi-circle-fill mr-1" style="font-size: 0.5rem;"></i>
                                {{ ucfirst($payment->status) }}
                              </span>
                            </div>
                          @empty
                            <div class="text-center py-4 text-sm text-gray-500">
                              <i class="bi bi-credit-card-2-front-fill text-gray-400 mb-2" style="font-size: 1.5rem;"></i>
                              <p>No recent payments for {{ $hostel->name }}</p>
                            </div>
                          @endforelse
                        </div>
                      </div>
                    @empty
                      <div class="text-center py-4 text-sm text-gray-500">
                        <i class="bi bi-credit-card-2-front-fill text-gray-400 mb-2" style="font-size: 1.5rem;"></i>
                        <p>No hostels found</p>
                      </div>
                    @endforelse
                  </div>
                  
            </div>
        </div>
    </div>
    
</div>

    </div>
@endsection