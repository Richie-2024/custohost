@extends('layouts.general')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Navigation -->
    <nav class="mb-6 flex items-center text-sm space-x-2">
        <a href="{{ route('profile.show') }}" class="text-blue-400 hover:text-blue-600 transition-colors">Profile</a>
        <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
        <span class="text-blue-700">Edit Profile</span>
    </nav>

    <!-- Edit Profile Form -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="bi bi-person text-blue-600 text-xl"></i>
                </div>
                <h1 class="text-xl font-semibold text-gray-900">Edit Profile</h1>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Profile Image -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Profile Image
                    </label>
                    <div class="flex items-center gap-4">
                        @if($user->profile_image)
                            <img src="{{ Storage::url($user->profile_image) }}" 
                                 alt="{{ $user->name }}" 
                                 class="h-16 w-16 rounded-full object-cover border-2 border-gray-200">
                        @else
                            <div class="h-16 w-16 rounded-full bg-gray-100 flex items-center justify-center border-2 border-gray-200">
                                <i class="bi bi-person text-gray-400 text-2xl"></i>
                            </div>
                        @endif
                        <input type="file" name="profile_image" id="profile_image" accept="image/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    @error('profile_image')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Full Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="space-y-2">
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        Phone Number
                    </label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('phone')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="space-y-2">
                    <label for="sex" class="block text-sm font-medium text-gray-700">
                        Gender
                    </label>
                    <select name="sex" id="sex" 
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select gender</option>
                        <option value="M" {{ old('sex', $user->sex) === 'M' ? 'selected' : '' }}>Male</option>
                        <option value="F" {{ old('sex', $user->sex) === 'F' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('sex')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Birthdate -->
                <div class="space-y-2">
                    <label for="birthdate" class="block text-sm font-medium text-gray-700">
                        Date of Birth
                    </label>
                    <input type="date" name="birthdate" id="birthdate" 
                           value="{{ old('birthdate', $user->birthdate?->format('Y-m-d')) }}"
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('birthdate')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="space-y-2">
                    <label for="address" class="block text-sm font-medium text-gray-700">
                        Address
                    </label>
                    <textarea name="address" id="address" rows="3"
                              class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                        <i class="bi bi-check-lg mr-2"></i>
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection