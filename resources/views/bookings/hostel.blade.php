@php
$hostel =Session::get('hostel_id')
@endphp
@extends('layouts.general')

@section('content')



<!-- Main Content Wrapper -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @hostel_manager
<nav class="mb-6 flex items-center text-sm space-x-2">
    <a href="{{route('hostels.show',$hostel)}}" class="text-blue-400 hover:text-blue-600 transition-colors">Back</a>
    <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
    <a href="{{ route('hostels.index') }}" class="text-blue-700 hover:text-blue-600 transition-colors">Manage Bookings</a>
</nav>
@endhostel_manager

    <!-- Filters Section -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                <i class="bi bi-funnel-fill text-gray-500"></i>
                Filters
            </h3>

            <!-- Filter Form -->
            <form action="#" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <!-- Date Filter -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
                </div>

                <!-- Apply Filters Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm">
                        <i class="bi bi-arrow-repeat mr-2"></i>
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Booking List Section -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Booking List</h3>
                <div class="flex items-center gap-4 text-sm text-gray-500">
                    <i class="bi bi-info-circle-fill"></i>
                    Total: {{ $bookings->count() }} bookings
                </div>
            </div>
        </div>

        <!-- Table Wrapper -->
       <!-- Bookings Table & Pagination -->
<div class="overflow-x-auto rounded-lg shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Booking ID</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Room</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dates</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $booking->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $booking->student->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Room {{ $booking->room->room_number ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        <div>
                            {{ optional($booking->check_in_date)->format('M d, Y') ?? 'N/A' }} → 
                            {{ optional($booking->check_out_date)->format('M d, Y') ?? 'N/A' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-700' : 
                               ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                               'bg-red-100 text-red-700') }}">
                            <i class="bi bi-circle-fill mr-2"></i>
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <!-- Status Badge -->
                        <div class="flex items-center justify-center gap-2 mb-2">
                            @php
                                $status = strtolower($booking->status);
                    
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'confirmed' => 'bg-blue-100 text-blue-800',
                                    'active' => 'bg-green-100 text-green-800',
                                    'completed' => 'bg-gray-100 text-gray-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusIcons = [
                                    'pending' => 'clock',
                                    'confirmed' => 'check2-circle',
                                    'active' => 'play-circle',
                                    'completed' => 'check-circle',
                                    'cancelled' => 'x-circle',
                                ];
                            @endphp
                    
                          
                        </div>
                    
                        <!-- Action Buttons -->
                        <div class="flex items-center justify-center gap-4">
                            <!-- Always show View -->
                            <a href="{{ route('bookings.show', $booking) }}" 
                               class="text-green-600 hover:text-green-800 transition-colors duration-200" 
                               title="View Booking" 
                               aria-label="View Booking">
                                <i class="bi bi-eye-fill text-xl"></i>
                            </a>
                    
                            @if ($status === 'pending')
                                <!-- Approve Booking -->
                                <form action="{{ route('bookings.approve', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Approve this booking?');">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:text-blue-800 transition-colors duration-200" title="Approve Booking" aria-label="Approve Booking">
                                        <i class="bi bi-check-lg text-xl"></i>
                                    </button>
                                </form>
                    
                                <!-- Reject Booking -->
                                <form action="{{ route('bookings.reject', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Reject this booking?');">
                                    @csrf
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-800 transition-colors duration-200" title="Reject Booking" aria-label="Reject Booking">
                                        <i class="bi bi-x-lg text-xl"></i>
                                    </button>
                                </form>
                            
                            @elseif ($status === 'confirmed' || $status === 'active')
                                <!-- Cancel Booking -->
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Cancel this booking?');">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-200" title="Cancel Booking" aria-label="Cancel Booking">
                                        <i class="bi bi-x-octagon-fill text-xl"></i>
                                    </button>
                                </form>
                    
                            @elseif ($status === 'cancelled')
                                <!-- Optional: Approve again if needed -->
                                <form action="{{ route('bookings.approve', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Approve this cancelled booking?');">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 transition-colors duration-200" title="Approve Cancelled Booking" aria-label="Approve Cancelled Booking">
                                        <i class="bi bi-arrow-clockwise text-xl"></i>
                                    </button>
                                </form>
                    
                            @endif
                        </div>
                    </td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                        <div class="flex flex-col items-center space-y-4">
                            <i class="bi bi-calendar-x-fill text-4xl"></i>
                            <p class="text-sm">No bookings found</p>
                            <a href="{{ route('bookings.create',$hostel) }}" class="inline-flex items-center gap-2 text-green-600 hover:text-green-800 text-sm font-semibold">
                                <i class="bi bi-plus-lg"></i> Add your first booking
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Section -->
    @if ($bookings->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 flex justify-center">
        <div class="text-blue-600">
            {{ $bookings->links() }}
        </div>
    </div>
@endif

</div>


       
       
    </div>
</div>

@endsection
