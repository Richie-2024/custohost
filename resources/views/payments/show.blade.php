@extends('layouts.general')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Navigation -->
    <nav class="mb-6 flex items-center text-sm space-x-2">
        <a href="{{ route('payments.index') }}" class="text-blue-400 hover:text-blue-600 transition-colors">
            Back to Payments
        </a>
        <i class="bi bi-chevron-right text-blue-300 text-xs"></i>
        <span class="text-blue-700">Payment Details</span>
    </nav>

    <!-- Payment Header -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="bi bi-credit-card text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">Payment #{{ $payment->id }}</h1>
                        <p class="text-sm text-gray-500">Created on {{ $payment->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                @if($payment->status!='completed')
                <form action="{{ route('payments.confirm', $payment->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-sm">
                        <i class="bi bi-check-circle mr-2"></i>
                        Confirm Payment
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Payment Details -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
              <div class="p-6">
                  <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                      <i class="bi bi-info-circle-fill text-blue-600"></i>
                      Payment Information
                  </h2>
          
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <!-- Payment Amount -->
                      <div class="p-3 rounded-lg bg-gray-50 border border-gray-200">
                          <h4 class="text-sm font-medium text-gray-600">Amount</h4>
                          <p class="mt-2 text-lg font-semibold text-gray-900">
                              UGX {{ number_format($payment->amount, 0) }}
                          </p>
                      </div>
          
                      <!-- Payment Status -->
                      <div class="p-3 rounded-lg bg-gray-50 border border-gray-200">
                          <h4 class="text-sm font-medium text-gray-600">Status</h4>
                          <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium
                              {{ $payment->status === 'completed' ? 'bg-green-50 border border-green-200' : 
                                 ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                 'bg-red-100 text-red-800') }}">
                              <i class="text-xs mr-1 
                                  {{ $payment->status === 'completed' ? 'bi bi-check-circle-fill' : 
                                     ($payment->status === 'pending' ? 'bi bi-hourglass-split' : 
                                     'bi bi-x-circle-fill') }}"></i>
                              {{ ucfirst($payment->status) }}
                          </span>
                      </div>
          
                      <!-- Payment Date -->
                      <div class="p-3 rounded-lg bg-gray-50 border border-gray-200">
                          <h4 class="text-sm font-medium text-gray-600">Payment Date</h4>
                          <p class="mt-2 text-sm text-gray-900">
                              {{ $payment->payment_date->format('M d, Y H:i') }}
                          </p>
                      </div>
          
                      <!-- Payment Method -->
                      <div class="p-3 rounded-lg bg-gray-50 border border-gray-200">
                          <h4 class="text-sm font-medium text-gray-600">Payment Method</h4>
                          <p class="mt-2 text-sm text-gray-900">
                              {{ ucfirst($payment->payment_method ?? 'Not specified') }}
                          </p>
                      </div>
          
                      @if($payment->reference_number)
                      <!-- Reference Number -->
                      <div class="p-3 rounded-lg bg-gray-50 border border-gray-200">
                          <h4 class="text-sm font-medium text-gray-600">Reference Number</h4>
                          <p class="mt-2 text-sm text-gray-900">{{ $payment->reference_number }}</p>
                      </div>
                      @endif
          
                      @if($payment->notes)
                      <!-- Notes -->
                      <div class="md:col-span-2 p-3 rounded-lg bg-gray-50 border border-gray-200">
                          <h4 class="text-sm font-medium text-gray-600">Notes</h4>
                          <p class="mt-2 text-sm text-gray-900">{{ $payment->notes }}</p>
                      </div>
                      @endif
                  </div>
              </div>
          </div>
          

            <!-- Booking Details -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-6">
                        <i class="bi bi-calendar-event text-gray-500"></i>
                        Related Booking
                    </h2>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="bi bi-building text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">
                                        Room {{ $payment->booking->room->room_number }}
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        {{ $payment->booking->hostel->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $payment->booking->check_in_date->format('M d, Y') }} - 
                                    {{ $payment->booking->check_out_date->format('M d, Y') }}
                                </p>
                                <p class="text-xs text-gray-500">
                                  {{ (int) $payment->booking->check_in_date->diffInDays($payment->booking->check_out_date) }} days
                              </p>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Student Information -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                        <i class="bi bi-person text-gray-500"></i>
                        Student Information
                    </h2>
                    
                    <div class="flex items-center gap-4">
                        <div class="h-16 w-16 rounded-full bg-gray-100 flex items-center justify-center">
                            <i class="bi bi-person-fill text-gray-400 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">
                                {{ $payment->booking->student->name }}
                            </h4>
                            <p class="text-sm text-gray-500">
                                {{ $payment->booking->student->email }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $payment->booking->student->phone }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment History -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
                        <i class="bi bi-clock-history text-gray-500"></i>
                        Payment History
                    </h2>
                    <div class="space-y-4">
                      @foreach($payment->booking->payments()->latest()->take(5)->get() as $historyPayment)
                      <div class="flex items-center justify-between p-3 rounded-lg 
                          {{ $historyPayment->status === 'completed' ? 'bg-green-50 border border-green-200' : 
                             ($historyPayment->status === 'pending' ? 'bg-yellow-50 border border-yellow-200' : 
                             'bg-red-50 border border-red-200') }}">
                          <div class="flex items-center gap-3">
                              <i class="text-lg 
                                  {{ $historyPayment->status === 'completed' ? 'bi bi-check-circle-fill text-green-600' : 
                                     ($historyPayment->status === 'pending' ? 'bi bi-hourglass-split text-yellow-600' : 
                                     'bi bi-x-circle-fill text-red-600') }}"></i>
                              
                              <div>
                                  <p class="text-sm font-medium text-gray-900">
                                      UGX {{ number_format($historyPayment->amount, 0) }}
                                  </p>
                                  <p class="text-xs text-gray-500">
                                      {{ $historyPayment->created_at->format('M d, Y') }}
                                  </p>
                              </div>
                          </div>
                  
                          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                              {{ $historyPayment->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                 ($historyPayment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                 'bg-red-100 text-red-800') }}">
                              {{ ucfirst($historyPayment->status) }}
                          </span>
                      </div>
                      @endforeach
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection