@extends('layouts.general')

@section('content')
<div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    @hostel_manager
    <nav class="mb-6 flex items-center text-sm space-x-2">
        <a href="{{url()->previous()}}" class="text-blue-400 hover:text-blue-600 transition-colors">Back</a>
        <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
        <a href="{{ route('hostels.index') }}" class="text-blue-700 hover:text-blue-600 transition-colors">Add Room.</a>
    </nav>
    @endhostel_manager
    <div class="bg-white shadow-lg rounded-xl border border-gray-200">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 p-2 rounded-lg border border-blue-200">
                    <i class="bi bi-door-open-fill text-blue-600 text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Add New Room</h1>
            </div>
        </div>

        <div class="p-6">
            <form action="{{ route('rooms.store',$hostel) }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="hostel_id" value="{{ $hostel->id}}">

                <!-- Basic Information -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="bi bi-info-circle-fill text-blue-600"></i>
                        Basic Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Room Number -->
                        <div>
                            <label for="room_number" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-hash text-gray-400 mr-1"></i>
                                Room Number
                            </label>
                            <input type="text" name="room_number" id="room_number"
                                   value="{{ old('room_number') }}"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   required>
                            @error('room_number')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-layout-three-columns text-gray-400 mr-1"></i>
                                Room Type
                            </label>
                            <select name="type" id="type"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    required>
                                <option value="">Select Type</option>
                                <option value="single" {{ old('type') == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="double" {{ old('type') == 'double' ? 'selected' : '' }}>Double</option>
                                <option value="triple" {{ old('type') == 'triple' ? 'selected' : '' }}>Triple</option>
                                <option value="quad" {{ old('type') == 'quad' ? 'selected' : '' }}>Quad</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-people-fill text-gray-400 mr-1"></i>
                                Capacity
                            </label>
                            <input type="number" name="capacity" id="capacity"
                                   value="{{ old('capacity') }}" min="1"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   required>
                            @error('capacity')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-cash-coin text-gray-400 mr-1"></i>
                                Price (per month)
                            </label>
                            <input type="number" name="price" id="price"
                                   value="{{ old('price') }}" step="0.01" min="0"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   required>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-toggle-on text-gray-400 mr-1"></i>
                                Status
                            </label>
                            <select name="status" id="status"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    required>
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="bi bi-text-paragraph text-gray-400 mr-1"></i>
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4"
                                  class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Room Amenities -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="bi bi-check2-square text-blue-600"></i>
                        Room Amenities
                    </h2>

                    @php
                        $amenities = [
                            'Air Conditioning',
                            'Private Bathroom',
                            'Study Table',
                            'Wardrobe',
                            'Wi-Fi',
                            'Hot Water',
                            'Laundry Service',
                            'Cleaning Service',
                            'TV'
                        ];
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($amenities as $amenity)
                            <div class="flex items-center">
                                <input type="checkbox"
                                       name="amenities[]"
                                       value="{{ $amenity }}"
                                       id="amenity_{{ Str::slug($amenity) }}"
                                       {{ in_array($amenity, old('amenities', [])) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="amenity_{{ Str::slug($amenity) }}"
                                       class="ml-2 block text-sm text-gray-900">
                                    {{ $amenity }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('amenities')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('rooms.index',$hostel->id) }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="bi bi-x-lg mr-2"></i>
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="bi bi-check-lg mr-2"></i>
                        Create Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
