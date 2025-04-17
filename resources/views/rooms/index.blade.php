<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
                <i data-lucide="layout-grid" class="h-6 w-6 text-gray-600"></i>
                {{ __('Manage Rooms') }}
            </h2>
            <a href="{{ route('rooms.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                Add New Room
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Filters -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-6">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                    <i data-lucide="filter" class="h-5 w-5 text-gray-500"></i>
                    Filters
                </h3>
                <form action="{{ route('rooms.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">All Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="occupied" {{ request('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                            <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
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
                    <div class="flex items-end">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 shadow-sm">
                            <i data-lucide="refresh-cw" class="h-4 w-4 mr-2"></i>
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Room List -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Room List</h3>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <i data-lucide="info" class="h-4 w-4"></i>
                            Total: {{ $rooms->total() }} rooms
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($rooms as $room)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 rounded-lg p-3 mr-3">
                                            <i data-lucide="door-open" class="h-5 w-5 text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Room {{ $room->room_number }}</div>
                                            <div class="text-sm text-gray-500">ID: #{{ $room->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ ucfirst($room->type) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $room->capacity }} persons</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">₹{{ number_format($room->price, 2) }}</div>
                                    <div class="text-xs text-gray-500">per month</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $room->status === 'available' ? 'bg-green-100 text-green-800' : 
                                           ($room->status === 'maintenance' ? 'bg-yellow-100 text-yellow-800' : 
                                           'bg-red-100 text-red-800') }}">
                                        <i data-lucide="circle" class="h-2 w-2 mr-1"></i>
                                        {{ ucfirst($room->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('rooms.show', $room) }}" 
                                           class="text-blue-600 hover:text-blue-900">View</a>
                                        <a href="{{ route('rooms.edit', $room) }}" 
                                           class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('rooms.destroy', $room) }}" 
                                              method="POST" 
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this room?');">
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
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center py-8">
                                        <i data-lucide="door-closed" class="h-12 w-12 text-gray-400 mb-4"></i>
                                        <p class="text-gray-500 mb-2">No rooms found</p>
                                        <a href="{{ route('rooms.create') }}" 
                                           class="text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                                            <i data-lucide="plus" class="h-4 w-4"></i>
                                            Add your first room
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($rooms->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $rooms->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>