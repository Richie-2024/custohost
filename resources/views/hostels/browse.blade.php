@extends('layouts.general') 
@section('content')
        <div class="flex items-center justify-between mt-4">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
                <i data-lucide="search" class="h-6 w-6 text-gray-600"></i>
                {{ __('Browse Hostels') }}
            </h2>
            <div class="flex items-center gap-3">
                <form action="{{ route('hostels.browse') }}" method="GET" class="flex items-center gap-2">
                    <input type="text" 
                           name="search" 
                           placeholder="Search hostels..."
                           value="{{ request('search') }}"
                           class="rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                        <i data-lucide="search" class="h-4 w-4 mr-2"></i>
                        Search
                    </button>
                </form>
            </div>
        </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Filters -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i data-lucide="filter" class="h-5 w-5 text-gray-500"></i>
                    Filters
                </h3>
                <form action="{{ route('hostels.browse') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">All</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                    <div>
                        <label for="rooms" class="block text-sm font-medium text-gray-700 mb-1">Available Rooms</label>
                        <select name="rooms" id="rooms" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Any</option>
                            <option value="1" {{ request('rooms') == '1' ? 'selected' : '' }}>At least 1</option>
                            <option value="5" {{ request('rooms') == '5' ? 'selected' : '' }}>At least 5</option>
                            <option value="10" {{ request('rooms') == '10' ? 'selected' : '' }}>At least 10</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 flex items-end">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm">
                            <i data-lucide="refresh-cw" class="h-4 w-4 mr-2"></i>
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hostel Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($hostels as $hostel)
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="aspect-w-16 aspect-h-9">
                        @if($hostel->photo)
                            <img src="{{ Storage::url($hostel->photo) }}" 
                                 alt="{{ $hostel->name }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                <i data-lucide="image" class="h-12 w-12 text-gray-400"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $hostel->name }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ Str::limit($hostel->address, 50) }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $hostel->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                <i data-lucide="circle" class="h-2 w-2 mr-1"></i>
                                {{ ucfirst($hostel->status) }}
                            </span>
                        </div>
                        
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="home" class="h-4 w-4 text-gray-500"></i>
                                    <span class="text-sm text-gray-700">{{ $hostel->available_rooms }} rooms available</span>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="users" class="h-4 w-4 text-gray-500"></i>
                                    <span class="text-sm text-gray-700">{{ $hostel->bookings_count ?? 0 }} students</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <a href="{{ route('hostels.details', $hostel) }}" 
                               class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                                View Details
                                <i data-lucide="chevron-right" class="h-4 w-4"></i>
                            </a>
                            @if($hostel->available_rooms > 0 && $hostel->status === 'active')
                                <a href="{{ route('bookings.create', ['hostel_id' => $hostel->id]) }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                                    <i data-lucide="calendar-plus" class="h-4 w-4 mr-1"></i>
                                    Book Now
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center">
                        <div class="flex flex-col items-center">
                            <div class="h-12 w-12 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="search-x" class="h-6 w-6 text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">No Hostels Found</h3>
                            <p class="text-sm text-gray-500">Try adjusting your search or filter criteria</p>
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