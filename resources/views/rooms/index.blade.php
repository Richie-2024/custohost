@extends('layouts.general')

@section('content')



<!-- Main Content Wrapper -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @hostel_manager
    <nav class="mb-6 flex items-center text-sm space-x-2">
        <a href="{{route('hostels.show',$hostel)}}" class="text-blue-400 hover:text-blue-600 transition-colors">Back to {{$hostel->name}} </a>
        <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
        <a href="{{ route('hostels.index') }}" class="text-blue-700 hover:text-blue-600 transition-colors">Manage Rooms.</a>
    </nav>
    @endhostel_manager
    <!-- Filters Section -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                <i class="bi bi-funnel-fill text-gray-500"></i>
                Filters
            </h3>

            <!-- Filter Form -->
            <form action="{{ route('rooms.index', $hostel) }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                
                <!-- Room Type Filter -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Room Type</label>
                    <select name="type" id="type" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">All Types</option>
                        <option value="single" {{ request('type') == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="double" {{ request('type') == 'double' ? 'selected' : '' }}>Double</option>
                        <option value="triple" {{ request('type') == 'triple' ? 'selected' : '' }}>Triple</option>
                        <option value="quad" {{ request('type') == 'quad' ? 'selected' : '' }}>Quad</option>
                    </select>
                </div>

                <!-- Room Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">All Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="occupied" {{ request('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                        <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

                <!-- Room Capacity Filter -->
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
                    <select name="capacity" id="capacity" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Any Capacity</option>
                        <option value="1" {{ request('capacity') == '1' ? 'selected' : '' }}>1 Person</option>
                        <option value="2" {{ request('capacity') == '2' ? 'selected' : '' }}>2 Persons</option>
                        <option value="3" {{ request('capacity') == '3' ? 'selected' : '' }}>3 Persons</option>
                        <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4 Persons</option>
                    </select>
                </div>

                <!-- Apply Filters Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm">
                        <i class="bi bi-arrow-repeat mr-2"></i>
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Room List Section -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Room List</h3>
                <div class="flex items-center gap-4 text-sm text-gray-500">
                    <i class="bi bi-info-circle-fill"></i>
                    Total: {{ $rooms->total() }} rooms
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-500">
                            <a href="{{ route('rooms.create', $hostel) }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    <i class="bi bi-plus-lg"></i>
                    Add Room
                </a>
                </div>
            </div>
        </div>

        <!-- Table Wrapper -->
        <div class="overflow-x-auto rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Room</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Capacity</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price(UGX)</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($rooms as $room)
                        <tr class="hover:bg-gray-50 transition">
                            <!-- Room Details -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 text-blue-600 rounded-lg p-2 mr-3">
                                        <i class="bi bi-door-open-fill text-lg"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">Room {{ $room->room_number }}</div>
                                        <div class="text-xs text-gray-500">ID: #{{ $room->id }}</div>
                                    </div>
                                </div>
                            </td>
        
                            <!-- Room Type -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800">{{ ucfirst($room->type) }}</div>
                            </td>
        
                            <!-- Room Capacity -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800">{{ $room->capacity }} persons</div>
                            </td>
        
                            <!-- Room Price -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ number_format($room->price, 2) }}</div>
                                <div class="text-xs text-gray-400">Per month</div>
                            </td>
        
                            <!-- Room Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $room->status === 'available' ? 'bg-green-100 text-green-700' : 
                                       ($room->status === 'maintenance' ? 'bg-yellow-100 text-yellow-700' : 
                                       'bg-red-100 text-red-700') }}">
                                    <i class="bi bi-circle-fill mr-2"></i>
                                    {{ ucfirst($room->status) }}
                                </span>
                            </td>
        
                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('rooms.show', $room) }}" class="text-blue-600 hover:text-blue-800" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
        
                                    <a href="{{ route('rooms.edit', $room) }}" class="text-indigo-600 hover:text-indigo-800" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
        
                                    <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this room?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="hostel_id" value="{{ $hostel->id }}">
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                                <div class="flex flex-col items-center space-y-4">
                                    <i class="bi bi-door-closed-fill text-4xl"></i>
                                    <p class="text-sm">No rooms found</p>
                                    <a href="{{ route('rooms.create', $hostel) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                        <i class="bi bi-plus-lg"></i> Add your first room
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Section -->
       
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $rooms->links() }}
        </div>
    </div>
</div>
@endsection