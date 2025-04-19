@extends('layouts.app')

@section('content')
<div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="mb-4 flex items-center space-x-2 text-sm text-gray-500">
        <a href="{{ route('roles.index') }}" class="hover:text-gray-700">Roles</a>
        <i class="bi bi-chevron-right text-xs"></i>
        <span class="text-gray-900">Create Role</span>
    </nav>

    <div class="bg-white shadow-lg rounded-xl border border-gray-200">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 p-2 rounded-lg border border-blue-200">
                    <i class="bi bi-shield-plus text-blue-600 text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Create New Role</h1>
            </div>
        </div>

        <div class="p-6">
            <form action="{{ route('roles.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Role Information -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="bi bi-shield text-blue-600"></i>
                        Role Information
                    </h2>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Role Name
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}" 
                               class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Permissions -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="bi bi-key text-blue-600"></i>
                        Permissions
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($permissions as $permission)
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="permissions[]" 
                                       value="{{ $permission->id }}"
                                       {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('permissions')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('roles.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="bi bi-x-lg mr-2"></i>
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        <i class="bi bi-check-lg mr-2"></i>
                        Create Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection