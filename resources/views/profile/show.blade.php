@extends('layouts.general')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Navigation -->
    <nav class="mb-6 flex items-center text-sm space-x-2">
        <a href="{{ route('dashboard') }}" class="text-blue-400 hover:text-blue-600 transition-colors">Dashboard</a>
        <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
        <span class="text-blue-700">Profile</span>
    </nav>

    <!-- Profile Header -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">
        <div class="p-6">
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
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-sm text-gray-500">Member since {{ $user->created_at->format('F Y') }}</p>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('profile.edit') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                        <i class="bi bi-pencil-square mr-2"></i>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Information -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                <i class="bi bi-person-lines-fill text-gray-500"></i>
                Personal Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Full Name</h4>
                    <p class="mt-2 text-sm text-gray-900">{{ $user->name }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Email Address</h4>
                    <p class="mt-2 text-sm text-gray-900">{{ $user->email }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Phone Number</h4>
                    <p class="mt-2 text-sm text-gray-900">{{ $user->phone ?? 'Not provided' }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Gender</h4>
                    <p class="mt-2 text-sm text-gray-900">{{ $user->sex === 'M' ? 'Male' : ($user->sex === 'F' ? 'Female' : 'Not specified') }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Date of Birth</h4>
                    <p class="mt-2 text-sm text-gray-900">{{ $user->birthdate ? $user->birthdate->format('F d, Y') : 'Not provided' }}</p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-500">Address</h4>
                    <p class="mt-2 text-sm text-gray-900">{{ $user->address ?? 'Not provided' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection