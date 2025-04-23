@extends('layouts.general')

@section('content')
<div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    
        @hostel_manager
        <nav class="mb-6 flex items-center text-sm space-x-2">
            <a href="{{ url()->previous()}}" class="text-blue-400 hover:text-blue-600 transition-colors">Back</a>
            <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
            <a href="{{ route('hostels.index') }}" class="text-blue-700 hover:text-blue-600 transition-colors">Create Hostels</a>
        </nav>
        @endhostel_manager
       


    <div class="bg-white shadow-lg rounded-xl border border-gray-200">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 p-2 rounded-lg border border-blue-200">
                    <i class="bi bi-house-add text-blue-600 text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Create New Hostel</h1>
            </div>
        </div>

        <div class="p-6">
            <form action="{{ route('hostels.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Basic Information -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="bi bi-info-circle-fill text-blue-600"></i>
                        Basic Information
                    </h2>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Hostel Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-type text-gray-400 mr-1"></i>
                                Hostel Name
                            </label>
                            <input type="hidden" name="owner_id" id="owner_id"
                                value="{{ Auth::id()}}">
                                
                            <input type="text" name="name" id="name"
                                value="{{ old('name') }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-geo-alt text-gray-400 mr-1"></i>
                                Address
                            </label>
                            <textarea name="address" id="address" rows="3"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required>{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
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
                </div>

                <!-- Hostel Photo -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="bi bi-image-fill text-blue-600"></i>
                        Hostel Photo
                    </h2>

                    <div class="flex items-center gap-6">
                        <div class="h-24 w-24 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-300">
                            <i class="bi bi-image text-3xl text-gray-400"></i>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="photo" id="photo" accept="image/*"

                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-2 text-xs text-gray-500">
                                Upload a clear image of your hostel (JPEG, PNG). Max: 2MB.
                            </p>
                            @error('photo')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Hostel Details -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="bi bi-gear-fill text-blue-600"></i>
                        Hostel Details
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-check-circle text-gray-400 mr-1"></i>
                                Status
                            </label>
                            <select name="status" id="status"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Total Rooms -->
                        <div>
                            <label for="total_rooms" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-door-closed text-gray-400 mr-1"></i>
                                Total Rooms
                            </label>
                            <input type="number" name="total_rooms" id="total_rooms" min="0"
                                value="{{ old('total_rooms', 0) }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required>
                            @error('total_rooms')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Available Rooms -->
                        <div>
                            <label for="available_rooms" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bi bi-door-open text-gray-400 mr-1"></i>
                                Available Rooms
                            </label>
                            <input type="number" name="available_rooms" id="available_rooms" min="0"
                                value="{{ old('available_rooms', 0) }}"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required>
                            @error('available_rooms')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('hostels.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="bi bi-x-lg mr-2"></i>
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="bi bi-check-lg mr-2"></i>
                        Create Hostel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
