<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight flex items-center gap-2">
                <i data-lucide="building" class="h-6 w-6 text-gray-600"></i>
                {{ $hostel->name }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('hostels.edit', $hostel) }}" 
                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                    <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                    Edit Hostel
                </a>
                <form action="{{ route('hostels.destroy', $hostel) }}" 
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this hostel?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm">
                        <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                        Delete Hostel
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                            <i data-lucide="info" class="h-5 w-5 text-gray-500"></i>
                            Basic Information
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Hostel Name</h4>
                                <p class="mt-2 text-sm text-gray-900">{{ $hostel->name }}</p>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Status</h4>
                                <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $hostel->status === 'active' ? 'bg-green-100 text-green-800' : 
                                       ($hostel->status === 'maintenance' ? 'bg-yellow-100 text-yellow-800' : 
                                       'bg-red-100 text-red-800') }}">
                                    <i data-lucide="circle" class="h-2 w-2 mr-1"></i>
                                    {{ ucfirst($hostel->status) }}
                                </span>
                            </div>

                            <div class="md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-500">Address</h4>
                                <p class="mt-2 text-sm text-gray-900">{{ $hostel->address }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-500">Description</h4>
                                <p class="mt-2 text-sm text-gray-900">{{ $hostel->description ?? 'No description available.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room Statistics -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <i data-lucide="layout-grid" class="h-5 w-5 text-gray-500"></i>
                                Room Statistics
                            </h3>
                            <a href="{{ route('rooms.create') }}" 
                               class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                                <i data-lucide="plus" class="h-4 w-4 mr-1"></i>
                                Add Room
                            </a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-100 rounded-lg p-2">
                                        <i data-lucide="home" class="h-5 w-5 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Total Rooms</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $hostel->total_rooms }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="bg-green-100 rounded-lg p-2">
                                        <i data-lucide="check-circle" class="h-5 w-5 text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Available</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $hostel->available_rooms }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="bg-red-100 rounded-lg p-2">
                                        <i data-lucide="x-circle" class="h-5 w-5 text-red-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Occupied</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $hostel->total_rooms - $hostel->available_rooms }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <i data-lucide="calendar" class="h-5 w-5 text-gray-500"></i>
                                Recent Bookings
                            </h3>
                            <a href="{{ route('bookings.index') }}" 
                               class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                                View All
                                <i data-lucide="chevron-right" class="h-4 w-4"></i>
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($hostel->bookings()->latest()->take(5)->get() as $booking)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                                        <i data-lucide="user" class="h-4 w-4 text-gray-500"></i>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900">{{ $booking->student->name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $booking->student->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Room {{ $booking->room->room_number }}</div>
                                                <div class="text-sm text-gray-500">{{ ucfirst($booking->room->type) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $booking->check_in_date->format('M d, Y') }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->check_in_date->format('h:i A') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $booking->status === 'active' ? 'bg-green-100 text-green-800' : 
                                                       ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                       'bg-gray-100 text-gray-800') }}">
                                                    <i data-lucide="circle" class="h-2 w-2 mr-1"></i>
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                                No recent bookings found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Hostel Photo -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                            <i data-lucide="image" class="h-5 w-5 text-gray-500"></i>
                            Hostel Photo
                        </h3>
                        
                        @if($hostel->photo)
                            <img src="{{ Storage::url($hostel->photo) }}" 
                                 alt="{{ $hostel->name }}"
                                 class="w-full h-48 object-cover rounded-lg">
                        @else
                            <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="image" class="h-12 w-12 text-gray-400"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                            <i data-lucide="zap" class="h-5 w-5 text-yellow-500"></i>
                            Quick Actions
                        </h3>
                        
                        <div class="space-y-3">
                            <a href="{{ route('rooms.create') }}" 
                               class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-100 rounded-lg p-2 group-hover:bg-blue-200 transition-colors">
                                        <i data-lucide="plus" class="h-5 w-5 text-blue-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">Add New Room</span>
                                </div>
                                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400 group-hover:text-gray-500"></i>
                            </a>

                            <a href="{{ route('bookings.create') }}" 
                               class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div class="bg-green-100 rounded-lg p-2 group-hover:bg-green-200 transition-colors">
                                        <i data-lucide="calendar-plus" class="h-5 w-5 text-green-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">Create Booking</span>
                                </div>
                                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400 group-hover:text-gray-500"></i>
                            </a>

                            <a href="{{ route('hostels.rooms', $hostel) }}" 
                               class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
                                <div class="flex items-center gap-3">
                                    <div class="bg-purple-100 rounded-lg p-2 group-hover:bg-purple-200 transition-colors">
                                        <i data-lucide="layout-grid" class="h-5 w-5 text-purple-600"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">Manage Rooms</span>
                                </div>
                                <i data-lucide="chevron-right" class="h-4 w-4 text-gray-400 group-hover:text-gray-500"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                            <i data-lucide="activity" class="h-5 w-5 text-gray-500"></i>
                            Recent Activity
                        </h3>
                        
                        <div class="space-y-4">
                            @foreach($hostel->bookings()->latest()->take(3)->get() as $booking)
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i data-lucide="calendar" class="h-4 w-4 text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-900">
                                            New booking by <span class="font-medium">{{ $booking->student->name }}</span>
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $booking->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>