{{-- resources/views/bookings/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                {{ __('Bookings') }}
            </h2>
            <a href="{{ route('bookings.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition">
                + New Booking
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if ($bookings->isEmpty())
            <div class="text-gray-500 text-center py-12">
                <i data-lucide="calendar-x" class="w-8 h-8 mx-auto text-gray-400 mb-2"></i>
                <p>No bookings found.</p>
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-2xl">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Customer</th>
                            <th class="px-6 py-3">Hostel</th>
                            <th class="px-6 py-3">Room</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-gray-900">{{ $booking->user->name }}</td>
                                <td class="px-6 py-4 text-gray-900">{{ $booking->hostel->name }}</td>
                                <td class="px-6 py-4 text-gray-900">{{ $booking->room_number }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $booking->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('bookings.show', $booking) }}"
                                        class="text-blue-600 hover:text-blue-800 font-semibold">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
