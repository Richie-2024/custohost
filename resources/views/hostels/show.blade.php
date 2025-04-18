@extends('layouts.general')
@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-6 bg-white sm:rounded-xl sm:shadow-sm sm:border sm:p-6 p-4">

        <!-- Hostel Title -->
        <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
            <i class="bi bi-building text-gray-600 text-xl"></i>
            {{ $hostel->name }}
        </h2>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 w-full sm:w-auto">
            <!-- Edit Hostel -->
            <a href="{{ route('hostels.edit', $hostel) }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm w-full sm:w-auto">
                <i class="bi bi-pencil-fill mr-2 text-sm"></i>
                Edit Hostel
            </a>

            <!-- Delete Hostel -->
            <form action="{{ route('hostels.destroy', $hostel) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this hostel?');"
                  class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm w-full sm:w-auto">
                    <i class="bi bi-trash-fill mr-2 text-sm"></i>
                    Delete Hostel
                </button>
            </form>
        </div>
    </div>
</div>




        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                                <i class="bi bi-info-circle text-gray-500"></i>
                                Basic Information
                            </h3>
        
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Hostel Name</h4>
                                    <p class="mt-2 text-sm text-gray-900">{{ $hostel->name }}</p>
                                </div>
        
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Status</h4>
                                    <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $hostel->status === 'active' ? 'bg-green-100 text-green-800' :
                                           ($hostel->status === 'maintenance' ? 'bg-yellow-100 text-yellow-800' :
                                           'bg-red-100 text-red-800') }}">
                                        <i class="bi bi-circle-fill mr-1 text-xs"></i>
                                        {{ ucfirst($hostel->status) }}
                                    </span>
                                </div>
        
                                <input type="hidden" name="hostel_id" value="{{ $hostel->id }}">
                                <div class="md:col-span-2">
                                    <h4 class="text-sm font-medium text-gray-500">Address</h4>
                                    <p class="mt-2 text-sm text-gray-900">{{ $hostel->address }}</p>
                                </div>
        
                                <div class="md:col-span-2">
                                    <h4 class="text-sm font-medium text-gray-500">Description</h4>
                                    <p class="mt-2 text-sm text-gray-900">{{ $hostel->description ?? 'No description available.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Room Statistics -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <i class="bi bi-grid-1x2-fill text-gray-500"></i>
                                    Room Statistics
                                </h3>
                                <a href="{{ route('rooms.create',$hostel) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                                    <i class="bi bi-plus-lg mr-1"></i>
                                    Add Room
                                </a>
                            </div>
        
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Total Rooms -->
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-blue-100 p-2 rounded-lg border border-blue-200">
                                            <i class="bi bi-house-door-fill text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Total Rooms</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $hostel->total_rooms }}</p>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Available -->
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-green-100 p-2 rounded-lg border border-green-200">
                                            <i class="bi bi-check-circle-fill text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Available</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $hostel->available_rooms }}</p>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Occupied -->
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-red-100 p-2 rounded-lg border border-red-200">
                                            <i class="bi bi-x-circle-fill text-red-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Occupied</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $hostel->total_rooms - $hostel->available_rooms }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Recent Bookings -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <i class="bi bi-calendar-event text-gray-500"></i>
                                    Recent Bookings
                                </h3>
                                <a href="{{route('bookings.hostel',$hostel)}}" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                                    View All
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
        
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($hostel->bookings()->latest()->take(5)->get() as $booking)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                                            <i class="bi bi-person-fill text-gray-500 text-sm"></i>
                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="text-sm font-medium text-gray-900">{{ $booking->student->name }}</div>
                                                            <div class="text-sm text-gray-500">{{ $booking->student->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">Room {{ $booking->room->room_number }}</div>
                                                    <div class="text-sm text-gray-500">{{ ucfirst($booking->room->type) }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">{{ $booking->check_in_date->format('M d, Y') }}</div>
                                                    <div class="text-sm text-gray-500">{{ $booking->check_in_date->format('h:i A') }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        {{ $booking->status === 'active' ? 'bg-green-100 text-green-800' :
                                                           ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                           'bg-gray-100 text-gray-800') }}">
                                                        <i class="bi bi-circle-fill mr-1 text-xs"></i>
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No recent bookings found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Sidebar -->
                <div class="space-y-6">
        
                    <!-- Hostel Photo -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                                <i class="bi bi-image text-gray-500"></i>
                                Hostel Photo
                            </h3>
        
                            @if($hostel->photo)
                                <img src="{{ Storage::url($hostel->photo) }}" alt="{{ $hostel->name }}" class="w-full h-48 object-cover rounded-lg">
                            @else
                                <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="bi bi-image text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>
        
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                                <i class="bi bi-lightning-charge-fill text-yellow-500"></i>
                                Quick Actions
                            </h3>
                    
                            <div class="space-y-3">
                                <!-- Add New Room -->
                                <a href="{{ route('rooms.create',$hostel) }}"
                                   class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-blue-100 rounded-lg p-2 group-hover:bg-blue-200 transition-colors">
                                            <i class="bi bi-plus-lg text-blue-600"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Add New Room</span>
                                    </div>
                                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-gray-500"></i>
                                </a>
                    
                                <!-- Create Booking -->
                                <a href="{{ route('bookings.create',$hostel) }}"
                                   class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-green-100 rounded-lg p-2 group-hover:bg-green-200 transition-colors">
                                            <i class="bi bi-calendar-plus text-green-600"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Create Booking</span>
                                    </div>
                                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-gray-500"></i>
                                </a>
                    
                                <!-- Manage Rooms -->
                                <a href="{{ route('rooms.index', $hostel) }}"
                                   class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-purple-100 rounded-lg p-2 group-hover:bg-purple-200 transition-colors">
                                            <i class="bi bi-grid-fill text-purple-600"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Manage Rooms</span>
                                    </div>
                                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-gray-500"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
        
                    <!-- Recent Activity -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                                <i class="bi bi-activity text-gray-500"></i>
                                Recent Activity
                            </h3>
        
                            <div class="space-y-4">
                                @foreach($hostel->bookings()->latest()->take(3)->get() as $booking)
                                    <div class="flex items-start gap-3">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="bi bi-calendar-event text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-900">New booking by <span class="font-medium">{{ $booking->student->name }}</span></p>
                                            <p class="text-xs text-gray-500">{{ $booking->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
        
@endsection