@extends('layouts.general')

@section('content')

{{-- Breadcrumb --}}
@hostel_manager
<nav class="mb-6 flex items-center text-sm space-x-2">
    <a href="{{ route('dashboard') }}" class="text-blue-400 hover:text-blue-600 transition-colors">Dashboard</a>
    <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
    <a href="{{ route('hostels.index') }}" class="text-blue-700 hover:text-blue-600 transition-colors">Manage Hostels</a>
</nav>
@endhostel_manager



{{-- Main Container --}}
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">

    {{-- Card --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-md overflow-hidden">

        {{-- Card Header --}}
        <div class="p-6 border-b border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h3 class="text-lg font-bold text-gray-800">Your Hostels</h3>

                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <i data-lucide="info" class="h-4 w-4"></i>
                        Total: {{ $hostels->count() }}
                    </div>

                    @if(Auth::user()->getRoleNames()->first() === 'hostel_manager')
                    <a href="{{ route('hostels.create') }}" 
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                     <i class="bi bi-plus-lg"></i>
                     Add New Hostel
                 </a>
                 
                    @endif
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Hostel</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Rooms</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($hostels as $hostel)
                        <tr class="hover:bg-gray-50 transition-colors">
                            {{-- Hostel Info --}}
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-4">
                                @if($hostel->photo)
                                    <img class="h-10 w-10 rounded-md object-cover" src="{{ Storage::url($hostel->photo) }}" alt="{{ $hostel->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-md bg-gray-100 flex items-center justify-center">
                                        <i data-lucide="building" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-medium text-gray-900">{{ $hostel->name }}</div>
                                    <div class="text-xs text-gray-400">#{{ $hostel->id }}</div>
                                </div>
                            </td>

                            {{-- Location --}}
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                {{ Str::limit($hostel->address, 50) }}
                            </td>

                            {{-- Rooms --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-gray-800">{{ $hostel->available_rooms }} / {{ $hostel->total_rooms }}</div>
                                <div class="text-xs text-gray-400">Available</div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $hostel->status === 'active' ? 'bg-green-100 text-green-700' : 
                                       ($hostel->status === 'maintenance' ? 'bg-yellow-100 text-yellow-700' : 
                                       'bg-red-100 text-red-700') }}">
                                    <i data-lucide="circle" class="h-2 w-2 mr-1"></i>
                                    {{ ucfirst($hostel->status) }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('hostels.show', $hostel) }}" 
                                       class="text-blue-600 hover:text-blue-800 font-medium transition">View</a>

                                    @if(Auth::user()->getRoleNames()->first() === 'hostel_manager')
                                        <a href="{{ route('hostels.edit', $hostel) }}" 
                                           class="text-indigo-600 hover:text-indigo-800 font-medium transition">Edit</a>

                                        <form action="{{ route('hostels.destroy', $hostel) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this hostel?');" 
                                              class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 font-medium transition">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <i data-lucide="building" class="h-12 w-12"></i>
                                    <p class="text-sm">No hostels found</p>
                                    <a href="{{ route('hostels.create') }}" 
                                       class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2 transition">
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

    </div>

</div>
@endsection
