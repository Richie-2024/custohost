@extends('layouts.general')
@section('content')

<nav class="mb-6 flex items-center text-sm space-x-2">
    <a href="{{route('rooms.index',$room->hostel)}}" class="text-blue-400 hover:text-blue-600 transition-colors">Back to Manage Rooms.</a>
    <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
    <a href="#" class="text-blue-700 hover:text-blue-600 transition-colors">View Room.</a>
</nav>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-6 bg-white sm:rounded-xl sm:shadow-sm sm:border sm:p-6 p-4">

        <!-- Room Title -->
        <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
            <i data-lucide="door-open" class="h-6 w-6 text-gray-600"></i>
            Room {{ $room->room_number }}
        </h2>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 w-full sm:w-auto">
            <!-- Edit Room -->
            <a href="{{ route('rooms.edit', $room) }}" 
               class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm w-full sm:w-auto">
                <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                Edit Room
            </a>

            <!-- Delete Room -->
            <form action="{{ route('rooms.destroy', $room) }}" 
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this room?');"
                  class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm w-full sm:w-auto">
                    <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                    <input type="hidden" name="hostel_id" value="{{$room->hostel->id}}">
                    Delete Room
                </button>
            </form>
        </div>

    </div>
</div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
             <!-- Room Information -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                    <i class="bi bi-info-circle text-gray-500"></i>
                    Room Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Room Number</h4>
                        <p class="mt-2 text-sm text-gray-900">{{ $room->room_number }}</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Room Type</h4>
                        <p class="mt-2 text-sm text-gray-900">{{ ucfirst($room->type) }}</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Capacity</h4>
                        <p class="mt-2 text-sm text-gray-900">{{ $room->capacity }} persons</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Price</h4>
                        <p class="mt-2 text-sm text-gray-900">UGX {{ number_format($room->price, 2) }} Per month</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Status</h4>
                        <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $room->status === 'available' ? 'bg-green-100 text-green-800' :
                            ($room->status === 'maintenance' ? 'bg-yellow-100 text-yellow-800' :
                            'bg-red-100 text-red-800') }}">
                            <i class="bi bi-circle-fill mr-1 text-xs"></i>
                            {{ ucfirst($room->status) }}
                        </span>
                    </div>

                    <div class="md:col-span-2">
                        <h4 class="text-sm font-medium text-gray-500">Description</h4>
                        <p class="mt-2 text-sm text-gray-900">{{ $room->description ?? 'No description available.' }}</p>
                    </div>
                </div>
            </div>
        </div>


                <!-- Amenities -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                            <i data-lucide="list-checks" class="h-5 w-5 text-gray-500"></i>
                            Room Amenities
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @php
                                $decodedAmenities = json_decode($room->amenities ?? '[]', true); // Decode amenities safely
                            @endphp
                        
                            @forelse ($decodedAmenities as $amenity)
                                <div class="flex items-center gap-2 bg-gray-50 rounded-lg p-3">
                                    <i data-lucide="check" class="h-4 w-4 text-green-500"></i>
                                    <span class="text-sm text-gray-900">{{ $amenity }}</span>
                                </div>
                            @empty
                                <div class="col-span-full text-center py-4">
                                    <p class="text-sm text-gray-500">No amenities listed</p>
                                </div>
                            @endforelse
                        </div>
                        
                    </div>
                </div>

                <!-- Current Booking -->
                @if($room->currentBooking)
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                                <i data-lucide="calendar" class="h-5 w-5 text-gray-500"></i>
                                Current Booking
                            </h3>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i data-lucide="user" class="h-5 w-5 text-gray-500"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">{{ $room->currentBooking->student->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $room->currentBooking->student->email }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $room->currentBooking->check_in_date->format('M d, Y') }} - 
                                            {{ $room->currentBooking->check_out_date->format('M d, Y') }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $room->currentBooking->check_in_date->diffInDays($room->currentBooking->check_out_date) }} days
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Hostel Information -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                            <i data-lucide="building" class="h-5 w-5 text-gray-500"></i>
                            Hostel Information
                        </h3>
                        
                        <div class="flex items-center gap-4">
                            @if($room->hostel->photo)
                                <img src="{{ Storage::url($room->hostel->photo) }}" 
                                     alt="{{ $room->hostel->name }}"
                                     class="h-16 w-16 rounded-lg object-cover">
                            @else
                                <div class="h-16 w-16 rounded-lg bg-gray-100 flex items-center justify-center">
                                    <i data-lucide="building" class="h-8 w-8 text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">{{ $room->hostel->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $room->hostel->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>

              <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                        <i class="bi bi-lightning-charge text-gray-500"></i>
                        Quick Actions
                    </h3>
                    
                    <div class="space-y-3">
                        @if($room->status !== 'maintenance')
                            <form action="{{ route('rooms.status.update', $room) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="maintenance">
                                <button type="submit" 
                                    class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-warning-subtle rounded-lg p-2 group-hover:bg-warning-emphasis transition-colors">
                                            <i class="bi bi-wrench-adjustable text-warning"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Mark as Maintenance</span>
                                    </div>
                                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-gray-500"></i>
                                </button>
                            </form>
                        @endif

                        @if($room->status === 'maintenance')
                            <form action="{{ route('rooms.status.update', $room) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="available">
                                <button type="submit" 
                                    class="w-full flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-success-subtle rounded-lg p-2 group-hover:bg-success-emphasis transition-colors">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Mark as Available</span>
                                    </div>
                                    <i class="bi bi-chevron-right text-gray-400 group-hover:text-gray-500"></i>
                                </button>
                            </form>
                        @endif

                        @if($room->status === 'available')
                            <a href="{{ route('bookings.create',  $room->hostel) }}" 
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div class="bg-primary-subtle rounded-lg p-2 group-hover:bg-primary-emphasis transition-colors">
                                        <i class="bi bi-calendar-plus text-primary"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">Create Booking</span>
                                </div>
                                <i class="bi bi-chevron-right text-gray-400 group-hover:text-gray-500"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Booking History -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                        <i class="bi bi-clock-history text-gray-500"></i>
                        Booking History
                    </h3>
                    
                    <div class="space-y-4">
                        @forelse($room->bookings()->latest()->take(5)->get() as $booking)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="bi bi-person-fill text-gray-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $booking->student->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $booking->check_in_date->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $booking->status === 'active' ? 'bg-green-100 text-green-800' : 
                                    ($booking->status === 'completed' ? 'bg-primary-100 text-primary-800' : 
                                    'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-500">No booking history available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
@endsection