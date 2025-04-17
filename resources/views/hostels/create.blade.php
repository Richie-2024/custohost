<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
                <i data-lucide="building-plus" class="h-6 w-6 text-gray-600"></i>
                {{ __('Add New Hostel') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <form action="{{ route('hostels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <i data-lucide="info" class="h-5 w-5 text-gray-500"></i>
                        Basic Information
                    </h3>
                    
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Hostel Name
                            </label>
                            <div class="mt-1">
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                Address
                            </label>
                            <div class="mt-1">
                                <textarea name="address" 
                                          id="address" 
                                          rows="3"
                                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                          required>{{ old('address') }}</textarea>
                            </div>
                            @error('address')
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
                                          rows="4"
                                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <i data-lucide="image" class="h-5 w-5 text-gray-500"></i>
                        Hostel Photo
                    </h3>
                    
                    <div class="mt-6">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <div class="h-24 w-24 rounded-lg bg-gray-100 flex items-center justify-center">
                                    <i data-lucide="image" class="h-8 w-8 text-gray-400"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <input type="file" 
                                       name="photo" 
                                       id="photo"
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="mt-2 text-xs text-gray-500">
                                    Upload a photo of your hostel. Maximum file size: 2MB. Supported formats: JPEG, PNG, JPG.
                                </p>
                            </div>
                        </div>
                        @error('photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <i data-lucide="settings" class="h-5 w-5 text-gray-500"></i>
                        Hostel Details
                    </h3>
                    
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="status" class="block text-sm font-medium text-gray-700">
                                Status
                            </label>
                            <div class="mt-1">
                                <select name="status" 
                                        id="status"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </div>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="total_rooms" class="block text-sm font-medium text-gray-700">
                                Total Rooms
                            </label>
                            <div class="mt-1">
                                <input type="number" 
                                       name="total_rooms" 
                                       id="total_rooms"
                                       value="{{ old('total_rooms', 0) }}"
                                       min="0"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                            </div>
                            @error('total_rooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="available_rooms" class="block text-sm font-medium text-gray-700">
                                Available Rooms
                            </label>
                            <div class="mt-1">
                                <input type="number" 
                                       name="available_rooms" 
                                       id="available_rooms"
                                       value="{{ old('available_rooms', 0) }}"
                                       min="0"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                            </div>
                            @error('available_rooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 flex items-center justify-end gap-4">
                    <a href="{{ route('hostels.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i data-lucide="save" class="h-4 w-4 mr-2"></i>
                        Create Hostel
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>