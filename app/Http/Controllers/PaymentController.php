<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\{PaymentService, BookingService};
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $bookingService;

    public function __construct(
        PaymentService $paymentService,
        BookingService $bookingService
    ) {
        $this->paymentService = $paymentService;
        $this->bookingService = $bookingService;
    }
    public function showpayment($id)
    {
        // Fetch the specific booking based on the ID
        $booking = $this->bookingService->findById($id);
    
        // Check if the booking exists
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking not found');
        }
    
        // Pass the booking data to the view
        return view('payment.show', compact('booking'));
    }
    
    
    public function index()
    {
        $user = auth()->user();
    
        $payments = $user->hasRole('hostel_manager')
            ? $this->paymentService->getPaymentsByHostel($user->hostel_id)
            : $this->paymentService->getPaymentsByStudent($user->id);
    
       
        if (!$user->hasRole('hostel_manager')) {
            $booking = \App\Models\Booking::with(['hostel', 'room'])
                ->where('student_id', $user->id)
                ->latest()
                ->first();
        }
    
        return view('payment.index', compact('payments', 'booking'));
    }
    

    public function create()
    {
        $bookings = $this->bookingService->getActiveBookings(auth()->user()->hostel_id);
        return view('payments.create', compact('bookings'));
    }

    public function store(PaymentRequest $request)
    {
        $payment = $this->paymentService->createPayment($request->validated());
        return redirect()->route('payments.show', $payment)
            ->with('success', 'Payment recorded successfully.');
    }

    public function show($id)
    {
        $payment = $this->paymentService->findById($id);
        return view('payments.show', compact('payment'));
    }

    public function createForBooking($bookingId)
    {
        $booking = $this->bookingService->findById($bookingId);
        return view('payments.create-for-booking', compact('booking'));
    }

    public function pending()
    {
        $pendingPayments = $this->paymentService->getPendingPayments(auth()->user()->hostel_id);
        return view('payments.pending', compact('pendingPayments'));
    }

    public function confirm($id)
    {
        $payment = $this->paymentService->findById($id);
        $this->paymentService->confirmPayment($payment);
        return back()->with('success', 'Payment confirmed successfully.');
    }
}