@extends('layouts.general')
@section('content')
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
                <i data-lucide="layout-dashboard" class="h-6 w-6 text-gray-600"></i>
                Hostel Manager Dashboard
            </h2>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Last updated: {{ now()->format('M d, Y h:i A') }}</span>
                <button onclick="window.location.reload()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <i data-lucide="refresh-cw" class="h-5 w-5 text-gray-500"></i>
                </button>
            </div>
        </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Hostels -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-50 rounded-lg p-3 border border-blue-100">
                            <i data-lucide="building" class="h-6 w-6 text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Hostels</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $hostels->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <a href="{{ route('hostels.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                            View All
                            <i data-lucide="chevron-right" class="h-4 w-4"></i>
                        </a>
                        <span class="text-gray-500">
                            <i data-lucide="trending-up" class="h-4 w-4 inline text-green-500"></i>
                            Active
                        </span>
                    </div>
                </div>
            </div>

            <!-- Active Bookings -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-50 rounded-lg p-3 border border-green-100">
                            <i data-lucide="calendar-check" class="h-6 w-6 text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Bookings</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $activeBookings->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <a href="{{ route('bookings.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                            Manage Bookings
                            <i data-lucide="chevron-right" class="h-4 w-4"></i>
                        </a>
                        <span class="text-gray-500">
                            <i data-lucide="users" class="h-4 w-4 inline text-green-500"></i>
                            Occupied
                        </span>
                    </div>
                </div>
            </div>

            <!-- Pending Bookings -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-yellow-50 rounded-lg p-3 border border-yellow-100">
                            <i data-lucide="clock" class="h-6 w-6 text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Bookings</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $pendingBookings->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <a href="{{ route('bookings.pending') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                            Review Pending
                            <i data-lucide="chevron-right" class="h-4 w-4"></i>
                        </a>
                        <span class="text-gray-500">
                            <i data-lucide="alert-circle" class="h-4 w-4 inline text-yellow-500"></i>
                            Needs Action
                        </span>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-purple-50 rounded-lg p-3 border border-purple-100">
                            <i data-lucide="wallet" class="h-6 w-6 text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                            <p class="text-2xl font-bold text-gray-900">UGX{{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <a href="{{ route('payments.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                            View Payments
                            <i data-lucide="chevron-right" class="h-4 w-4"></i>
                        </a>
                        <span class="text-gray-500">
                            <i data-lucide="trending-up" class="h-4 w-4 inline text-green-500"></i>
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
                                <i data-lucide="list" class="h-5 w-5 text-gray-500"></i>
                                Recent Bookings
                            </h3>
                            <a href="{{ route('bookings.index') }}" 
                               class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                                View All
                                <i data-lucide="chevron-right" class="h-4 w-4"></i>
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($activeBookings->take(5) as $booking)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                                        <i data-lucide="user" class="h-4 w-4 text-gray-500"></i>
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
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $booking->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    <i data-lucide="circle" class="h-2 w-2 mr-1"></i>
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                                <div class="flex flex-col items-center py-4">
                                                    <i data-lucide="inbox" class="h-8 w-8 text-gray-400 mb-2"></i>
                                                    No recent bookings found
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
                <!-- Action Buttons -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                            <i data-lucide="zap" class="h-5 w-5 text-yellow-500"></i>
                            Quick Actions
                        </h3>
                        <div class="space-y-3">
                            <a href="#" 
                            
                               class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-100 rounded-lg p-2 group-hover:bg-blue-200 transition-colors">
                                        <i data-lucide="building-2" class="h-5 w-5 text-blue-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">Add New Hostel</span>
                                </div>
                                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400 group-hover:text-gray-500"></i>
                            </a>
                            @foreach($hostels as $hostel)
                            <a href="{{ route('rooms.create',$hostel) }}" 
                               class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div class="bg-green-100 rounded-lg p-2 group-hover:bg-green-200 transition-colors">
                                        <i data-lucide="door-open" class="h-5 w-5 text-green-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">Add New Room</span>
                                </div>
                                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400 group-hover:text-gray-500"></i>
                            </a>
                            @endforeach

                            <a href="{{ route('bookings.pending') }}" 
                               class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div class="bg-yellow-100 rounded-lg p-2 group-hover:bg-yellow-200 transition-colors">
                                        <i data-lucide="clock" class="h-5 w-5 text-yellow-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">Review Pending Bookings</span>
                                </div>
                                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400 group-hover:text-gray-500"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Room Status -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                            <i data-lucide="home" class="h-5 w-5 text-indigo-500"></i>
                            Room Status
                        </h3>
                        <div class="space-y-4">
                            @foreach($hostels as $hostel)
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">{{ $hostel->name }}</h4>
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
                            <i data-lucide="credit-card" class="h-5 w-5 text-purple-500"></i>
                            Recent Payments
                        </h3>
                        <div class="space-y-3">
                            @forelse($hostels->first()->payments()->latest()->take(5)->get() as $payment)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-purple-100 rounded-lg p-2">
                                            <i data-lucide="{{ $payment->payment_method === 'card' ? 'credit-card' : ($payment->payment_method === 'cash' ? 'banknote' : 'landmark') }}" 
                                               class="h-4 w-4 text-purple-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">UGX{{ number_format($payment->amount, 2) }}</p>
                                            <p class="text-xs text-gray-500">{{ $payment->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $payment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        <i data-lucide="circle" class="h-2 w-2 mr-1"></i>
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-4 text-sm text-gray-500">
                                    <i data-lucide="credit-card-off" class="h-6 w-6 mx-auto mb-2 text-gray-400"></i>
                                    <p>No recent payments found</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection