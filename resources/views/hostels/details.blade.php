
@extends('layouts.general')
@section('content')
<!-- Header Section -->
<div class="bg-white rounded-2xl border border-gray-200 shadow-md p-6 mb-5 flex flex-wrap items-center justify-between gap-4">
    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
        <i data-lucide="building" class="h-7 w-7 text-blue-600"></i>
        {{ $hostel->name }}
    </h2>

    @if($hostel->available_rooms > 0 && $hostel->status === 'active')
        <a href="{{ route('bookings.create', ['hostel_id' => $hostel->id]) }}" 
           class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-full shadow-md transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i data-lucide="calendar-plus" class="h-5 w-5"></i>
            Book Now
        </a>
    @endif
</div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Photo Gallery -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    @if($hostel->photo)
                        <img src="{{ Storage::url($hostel->photo) }}" 
                             alt="{{ $hostel->name }}"
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-100 flex items-center justify-center">
                            <i data-lucide="image" class="h-16 w-16 text-gray-400"></i>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                            <i data-lucide="info" class="h-5 w-5 text-gray-500"></i>
                            About this Hostel
                        </h3>
                        <p class="text-gray-600">{{ $hostel->description ?? 'No description available.' }}</p>
                        
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-100 rounded-lg p-2">
                                        <i data-lucide="map-pin" class="h-5 w-5 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Location</p>
                                        <p class="text-sm text-gray-900">{{ $hostel->address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-green-100 rounded-lg p-2">
                                        <i data-lucide="check-circle" class="h-5 w-5 text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Status</p>
                                        <p class="text-sm text-gray-900">{{ ucfirst($hostel->status) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available Rooms -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                            <i data-lucide="door-open" class="h-5 w-5 text-gray-500"></i>
                            Available Rooms
                        </h3>

                        <div class="space-y-4">
                            @forelse($hostel->rooms()->where('status', 'available')->get() as $room)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div class="bg-blue-100 rounded-lg p-3">
                                                <i data-lucide="home" class="h-5 w-5 text-blue-600"></i>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">Room {{ $room->room_number }}</h4>
                                                <p class="text-sm text-gray-500">{{ ucfirst($room->type) }} Room</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-semibold text-gray-900">UGX{{ number_format($room->price, 2) }}</p>
                                            <p class="text-sm text-gray-500">Per month</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 grid grid-cols-3 gap-4">
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="users" class="h-4 w-4 text-gray-400"></i>
                                            <span class="text-sm text-gray-600">{{ $room->capacity }} Persons</span>
                                        </div>
                                        @if($room->amenities)
                                        @php
                                            // Decode the amenities JSON into an array
                                            $decodedAmenities = json_decode($room->amenities, true);
                                        @endphp
                                    
                                        @foreach(array_slice($decodedAmenities ?? [], 0, 2) as $amenity)
                                            <div class="flex items-center gap-2">
                                                <i data-lucide="check" class="h-4 w-4 text-green-500"></i>
                                                <span class="text-sm text-gray-600">{{ $amenity }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                    
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6">
                                    <div class="bg-gray-100 rounded-full h-12 w-12 flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="x" class="h-6 w-6 text-gray-400"></i>
                                    </div>
                                    <h4 class="text-sm font-medium text-gray-900">No Rooms Available</h4>
                                    <p class="text-sm text-gray-500 mt-1">Check back later for availability</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Stats -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                            <i data-lucide="chart-bar" class="h-5 w-5 text-gray-500"></i>
                            Quick Stats
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-green-100 rounded-lg p-2">
                                            <i data-lucide="home" class="h-5 w-5 text-green-600"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">Available Rooms</p>
                                    </div>
                                    <p class="text-lg font-semibold text-gray-900">{{ $hostel->available_rooms }}</p>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-blue-100 rounded-lg p-2">
                                            <i data-lucide="users" class="h-5 w-5 text-blue-600"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">Current Students</p>
                                    </div>
                                    <p class="text-lg font-semibold text-gray-900">{{ $hostel->bookings()->where('status', 'active')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                            <i data-lucide="contact" class="h-5 w-5 text-gray-500"></i>
                            Contact Information
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                        <i data-lucide="user" class="h-4 w-4 text-gray-500"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $hostel->owner->name }}</p>
                                    <p class="text-sm text-gray-500">Hostel Manager</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                        <i data-lucide="mail" class="h-4 w-4 text-gray-500"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $hostel->owner->email }}</p>
                                    <p class="text-sm text-gray-500">Email Address</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Book Now CTA -->
                @if($hostel->available_rooms > 0 && $hostel->status === 'active')
                    <div class="bg-blue-50 rounded-xl border border-blue-100 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">Ready to Book?</h3>
                            <p class="text-sm text-blue-700 mb-4">Secure your room now in {{ $hostel->name }}</p>
                            <a href="{{ route('bookings.create', ['hostel_id' => $hostel->id]) }}" 
                               class="block w-full text-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                                <i data-lucide="calendar-plus" class="h-4 w-4 inline-block mr-2"></i>
                                Book Now
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection