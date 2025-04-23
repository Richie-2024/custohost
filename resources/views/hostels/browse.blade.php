@extends('layouts.general')

@section('content')

<!-- Page Heading -->
<div class="mt-4 mb-6 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <!-- Title -->
        <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
            <i class="bi bi-house-door-fill text-gray-600 text-2xl"></i>
            {{ __('Browse Hostels') }}
        </h2>

        <!-- Error Message -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative w-full sm:w-auto" role="alert">
                <strong class="font-bold">{{ session('error') }}</strong>
            </div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('hostels.browse') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-2 w-full sm:w-auto">
            <input type="text" 
                   name="search" 
                   placeholder="Search hostels..." 
                   value="{{ request('search') }}" 
                   class="w-full sm:w-64 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-2">
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                <i class="bi bi-search mr-2"></i> Search
            </button>
        </form>
    </div>
</div>


<!-- Filters Section -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-8">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                <i class="bi bi-funnel-fill text-gray-500"></i> Filters
            </h3>

            <form action="{{ route('hostels.browse') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">All</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

                <!-- Available Rooms Filter -->
                <div>
                    <label for="rooms" class="block text-sm font-medium text-gray-700 mb-1">Available Rooms</label>
                    <select name="rooms" id="rooms" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Any</option>
                        <option value="1" {{ request('rooms') == '1' ? 'selected' : '' }}>At least 1</option>
                        <option value="5" {{ request('rooms') == '5' ? 'selected' : '' }}>At least 5</option>
                        <option value="10" {{ request('rooms') == '10' ? 'selected' : '' }}>At least 10</option>
                    </select>
                </div>

                <!-- Apply Filters Button -->
                <div class="md:col-span-2 flex items-end">
                    <button type="submit" 
                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 focus:ring-2 focus:ring-gray-500">
                        <i class="bi bi-arrow-clockwise me-2"></i> Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hostels Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($hostels as $hostel)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow">

                <!-- Hostel Image -->
                <div class="aspect-w-16 aspect-h-9">
                    @if($hostel->photo)
                        <img src="{{ Storage::url($hostel->photo) }}" 
                             alt="{{ $hostel->name }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <i class="bi bi-image text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Hostel Details -->
                <div class="p-6">

                    <!-- Hostel Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $hostel->name }}</h3>
                            <p class="text-sm text-gray-500">{{ Str::limit($hostel->address, 50) }}</p>
                        </div>

                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                     {{ $hostel->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            <i class="bi bi-circle-fill me-1 text-xs"></i> {{ ucfirst($hostel->status) }}
                        </span>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-lg p-3 flex items-center gap-2">
                            <i class="bi bi-door-open text-gray-500"></i>
                            <span class="text-sm text-gray-700">{{ $hostel->available_rooms }} rooms</span>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3 flex items-center gap-2">
                            <i class="bi bi-people-fill text-gray-500"></i>
                            <span class="text-sm text-gray-700">{{ $hostel->bookings_count ?? 0 }} students</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('hostels.details', $hostel) }}" 
                           class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                            View Details <i class="bi bi-chevron-right"></i>
                        </a>

                        @if($hostel->available_rooms > 0 && $hostel->status === 'active')
                            <a href="{{ route('bookings.create', $hostel) }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                                <i class="bi bi-calendar-plus me-1"></i> Book Now
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        @empty
            <!-- No Hostels Found -->
            <div class="col-span-full">
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center">
                    <div class="flex flex-col items-center">
                        <div class="h-12 w-12 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="bi bi-search text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">No Hostels Found</h3>
                        <p class="text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
      <!-- Pagination -->
        {{-- @if($hostels->hasPages())
            <div class="mt-6">
                {{ $hostels->links() }}
            </div>
        @endif --}}

</div>

@endsection
