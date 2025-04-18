{{-- resources/views/payments/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('My Payments') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            @if($payments->isEmpty())
                <div class="text-center text-gray-500">
                    <i data-lucide="file" class="w-8 h-8 mx-auto mb-2 text-gray-400"></i>
                    <p>No payments found.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto text-sm">
                        <thead class="bg-gray-100 text-left">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Amount</th>
                                <th class="px-4 py-2">Method</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Transaction ID</th>
                                <th class="px-4 py-2">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($payments as $payment)
                                <tr>
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 font-medium text-gray-900">Ugx:{{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $payment->payment_method }}</td>
                                    <td class="px-4 py-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium 
                                            {{ match($payment->status) {
                                                'completed' => 'bg-green-100 text-green-800',
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'failed' => 'bg-red-100 text-red-800',
                                                'refunded' => 'bg-blue-100 text-blue-800',
                                            } }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $payment->transaction_id ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y, h:i A') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
