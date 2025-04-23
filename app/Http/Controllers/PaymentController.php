<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\{PaymentService, BookingService};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        $user = Auth::user();
        $payments = $user->hasRole('hostel_manager')
            ? $this->paymentService->getPaymentsForOwnedHostels()
            : $this->paymentService->getPaymentsByStudent($user->id);

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $bookings = $this->bookingService->getActiveBookings();
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
        $pendingPayments = $this->paymentService->getPendingPayments(Auth::user()->hostel_id);
        return view('payments.pending', compact('pendingPayments'));
    }

    public function confirm($id)
    {
        $payment = $this->paymentService->findById($id);
        $this->paymentService->confirmPayment($payment);
        return back()->with('success', 'Payment confirmed successfully.');
    }
}