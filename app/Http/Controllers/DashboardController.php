<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\{HostelService, BookingService, PaymentService};
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Observers\UserObserver;
use App\Http\Middleware\EnsureUserIsHostelManager;
use App\Http\Middleware\EnsureUserIsStudent;

class DashboardController extends Controller
{
    protected $hostelService;
    protected $bookingService;
    protected $paymentService;

    public function __construct(
        HostelService $hostelService,
        BookingService $bookingService,
        PaymentService $paymentService
    ) {
        $this->hostelService = $hostelService;
        $this->bookingService = $bookingService;
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $user = Auth::user();
        
        // // if ($user->hasRole('hostel_manager')) {
        //     $hostels = $this->hostelService->getHostelsByOwner($user->id);
        //     $activeBookings = $this->bookingService->getActiveBookings($hostels->first()->id) ?? 0;
        //     $pendingBookings = $this->bookingService->getPendingBookings($hostels->first()->id);
        //     $totalRevenue = $this->paymentService->getTotalPaymentsForHostel($hostels->first()->id);

        //     return view('dashboard.hostel-manager', compact(
        //         'hostels',
        //         'activeBookings',
        //         'pendingBookings',
        //         'totalRevenue'
        //     ));
        // }

        // Student Dashboard
        $bookings = $this->bookingService->getBookingsByStudent($user->id);
        $activeBooking = $bookings->where('status', 'active')->first();
        $pendingPayments = $this->paymentService->getPendingPaymentsForHostel($activeBooking?->hostel_id ?? 0);

        return view('dashboard.student', compact(
            'bookings',
            'activeBooking',
            'pendingPayments'
        ));
    }
}