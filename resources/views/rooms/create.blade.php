<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
                <i data-lucide="plus-square" class="h-6 w-6 text-gray-600"></i>
                {{ __('Add New Room') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf

                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <i data-lucide="info" class="h-5 w-5 text-gray-500"></i>
                        Basic Information
                    </h3>
                    
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <input type="hidden" name="hostel_id" value="{{ request('hostel_id') }}">

                        <div class="sm:col-span-2">
                            <label for="room_number" class="block text-sm font-medium text-gray-700">
                                Room Number
                            </label>
                            <div class="mt-1">
                                <input type="text" 
                                       name="room_number" 
                                       id="room_number" 
                                       value="{{ old('room_number') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                            </div>
                            @error('room_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="type" class="block text-sm font-medium text-gray-700">
                                Room Type
                            </label>
                            <div class="mt-1">
                                <select name="type" 
                                        id="type"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                    <option value="">Select Type</option>
                                    <option value="single" {{ old('type') == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="double" {{ old('type') == 'double' ? 'selected' : '' }}>Double</option>
                                    <option value="triple" {{ old('type') == 'triple' ? 'selected' : '' }}>Triple</option>
                                    <option value="quad" {{ old('type') == 'quad' ? 'selected' : '' }}>Quad</option>
                                </select>
                            </div>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="capacity" class="block text-sm font-medium text-gray-700">
                                Capacity
                            </label>
                            <div class="mt-1">
                                <input type="number" 
                                       name="capacity" 
                                       id="capacity"
                                       value="{{ old('capacity') }}"
                                       min="1"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                            </div>
                            @error('capacity')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="price" class="block text-sm font-medium text-gray-700">
                                Price (per month)
                            </label>
                            <div class="mt-1">
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       value="{{ old('price') }}"
                                       min="0"
                                       step="0.01"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="status" class="block text-sm font-medium text-gray-700">
                                Status
                            </label>
                            <div class="mt-1">
                                <select name="status" 
                                        id="status"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </div>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea name="description" 
                                          id="description" 
                                          rows="3"
                                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                        <i data-lucide="list-checks" class="h-5 w-5 text-gray-500"></i>
                        Room Amenities
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
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
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="px-6 py-4 bg-gray-50 flex items-center justify-end gap-4">
                    <a href="{{ route('rooms.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i data-lucide="save" class="h-4 w-4 mr-2"></i>
                        Create Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>