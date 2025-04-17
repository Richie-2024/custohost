
@extends('layouts.general')
@section('content')
<div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
                <i data-lucide="building" class="h-6 w-6 text-gray-600"></i>
                {{ __('Manage Hostels') }}
            </h2>
            <a href="{{ route('hostels.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                Add New Hostel
            </a>
        </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Your Hostels</h3>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <i data-lucide="info" class="h-4 w-4"></i>
                            Total: {{ $hostels->count() }} hostels
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hostel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rooms</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($hostels as $hostel)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($hostel->photo)
                                            <img class="h-10 w-10 rounded-lg object-cover" 
                                                 src="{{ Storage::url($hostel->photo) }}" 
                                                 alt="{{ $hostel->name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                                <i data-lucide="building" class="h-5 w-5 text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $hostel->name }}</div>
                                            <div class="text-sm text-gray-500">ID: #{{ $hostel->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::limit($hostel->address, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $hostel->available_rooms }} / {{ $hostel->total_rooms }}</div>
                                    <div class="text-xs text-gray-500">Available</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $hostel->status === 'active' ? 'bg-green-100 text-green-800' : 
                                           ($hostel->status === 'maintenance' ? 'bg-yellow-100 text-yellow-800' : 
                                           'bg-red-100 text-red-800') }}">
                                        <i data-lucide="circle" class="h-2 w-2 mr-1"></i>
                                        {{ ucfirst($hostel->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('hostels.show', $hostel) }}" 
                                           class="text-blue-600 hover:text-blue-900">View</a>
                                        <a href="{{ route('hostels.edit', $hostel) }}" 
                                           class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('hostels.destroy', $hostel) }}" 
                                              method="POST" 
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this hostel?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center py-8">
                                        <i data-lucide="building" class="h-12 w-12 text-gray-400 mb-4"></i>
                                        <p class="text-gray-500 mb-2">No hostels found</p>
                                        <a href="{{ route('hostels.create') }}" 
                                           class="text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                                            <i data-lucide="plus" class="h-4 w-4"></i>
                                            Add your first hostel
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- @if($hostels->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $hostels->links() }}
                </div>
            @endif --}}
        </div>
    </div>
@endsection