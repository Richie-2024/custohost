
@extends('layouts.general')
@section('content')
@student
<nav class="mb-6 flex items-center text-sm space-x-2">
    <a href="{{route('hostels.browse')}}" class="text-blue-400 hover:text-blue-600 transition-colors">Browse More Hostels</a>
    <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
    <a href="{{ route('hostels.index') }}" class="text-blue-700 hover:text-blue-600 transition-colors">Explore {{$hostel->name}}</a>
</nav>
@endstudent
<!-- Header Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-md p-6 mb-5 flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                <i class="bi bi-building h-7 w-7 text-blue-600"></i>
                {{ $hostel->name }}
            </h2>

            @if($hostel->available_rooms > 0 && $hostel->status === 'active')
                <a href="{{ route('bookings.create', $hostel) }}" 
                class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-full shadow-md transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="bi bi-calendar-plus h-5 w-5"></i>
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
                    <img src="{{asset('images/logo.png')}}" 
                        alt="{{ $hostel->name }}"
                        class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-100 flex items-center justify-center">
                        <i class="bi bi-image text-gray-400 text-6xl"></i>
                    </div>
                @endif
            </div>

            <!-- Description -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                        <i class="bi bi-info-circle text-gray-500 h-5 w-5"></i>
                        About <span class="text-blue-500">{{ $hostel->name }}</span>
                    </h3>
                    <p class="text-gray-600">{{ $hostel->description ?? 'No description available.' }}</p>
                    
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-100 rounded-lg p-2">
                                    <i class="bi bi-geo-alt text-blue-600 h-5 w-5"></i>
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
                                    <i class="bi bi-patch-check text-green-600 h-5 w-5"></i>
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
                            <i class="bi bi-door-open text-gray-500 text-xl"></i>
                            Available Rooms
                        </h3>
                
                        <div class="space-y-4">
                            @forelse($hostel->rooms()->where('status', 'available')->get() as $room)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div class="bg-blue-100 rounded-lg p-3">
                                                <i class="bi bi-house-door-fill text-blue-600 text-lg"></i>
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
                                            <i class="bi bi-people text-gray-400 text-base"></i>
                                            <span class="text-sm text-gray-600">{{ $room->capacity }} Persons</span>
                                        </div>
                
                                        @if($room->amenities)
                                            @php
                                                $decodedAmenities = json_decode($room->amenities, true);
                                            @endphp
                
                                            @foreach(array_slice($decodedAmenities ?? [], 0, 2) as $amenity)
                                                <div class="flex items-center gap-2">
                                                    <i class="bi bi-check-circle-fill text-green-500 text-base"></i>
                                                    <span class="text-sm text-gray-600">{{ $amenity }}</span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6">
                                    <div class="bg-gray-100 rounded-full h-12 w-12 flex items-center justify-center mx-auto mb-4">
                                        <i class="bi bi-x-circle text-gray-400 text-2xl"></i>
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
                            <i class="bi bi-bar-chart-line text-gray-500 text-xl"></i>
                            Quick Stats
                        </h3>
                
                        <div class="space-y-5">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-green-100 rounded-lg p-2">
                                            <i class="bi bi-house-door text-green-600 text-lg"></i>
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
                                            <i class="bi bi-people-fill text-blue-600 text-lg"></i>
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
                            <i class="bi bi-person-rolodex text-gray-500 text-xl"></i>
                            Contact Information
                        </h3>
                
                        <div class="space-y-5">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                        <i class="bi bi-person text-gray-500 text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $hostel->owner->name }}</p>
                                    <p class="text-sm text-gray-500">Hostel Manager</p>
                                </div>
                            </div>
                
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                        <i class="bi bi-envelope text-gray-500 text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $hostel->owner->email }}</p>
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
                            <a href="{{ route('bookings.create', $hostel) }}" 
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