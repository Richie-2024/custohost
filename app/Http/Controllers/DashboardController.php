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
        $userRole = $user->getRoleNames()->first(); // Get the user's role
    
        switch ($userRole) {
            case 'hostel_manager':
                // Get all hostels owned by the user
                $hostels = $user->getOwnedHostels();
                $hostelIds = $hostels->pluck('id');
    
                // Fetch bookings and revenue using collection methods
                $activeBookings = $hostelIds->map(fn($id) => $this->bookingService->getActiveBookings())->flatten();
                $pendingBookings = $hostelIds->map(fn($id) => $this->bookingService->getPendingBookings($id))->flatten();
                $totalRevenue = $hostelIds->sum(fn($id) => $this->paymentService->getTotalPaymentsForHostel($id));
    
               
                return view('dashboard.hostel-manager', compact(
                    'hostels', 'activeBookings', 'pendingBookings', 'totalRevenue'
                ));
    
            case 'student':
                // Get student's bookings
                $bookings = $this->bookingService->getBookingsByStudent($user->id);
                $activeBooking = $bookings->firstWhere('status', 'confirmed');
                $pendingPayments = $this->paymentService->getPendingPaymentsForHostel($activeBooking?->hostel_id ?? 0);
    
                return view('dashboard.student', compact(
                    'bookings', 'activeBooking', 'pendingPayments'
                ));
    
            default:
                abort(403, 'Unauthorized access');
        }
    }
    
    
    
}
