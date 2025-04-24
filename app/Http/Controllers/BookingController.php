<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Hostel;
use App\Services\{BookingService, RoomService};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $bookingService;
    protected $roomService;

    public function __construct(
        BookingService $bookingService,
        RoomService $roomService
    ) {
        $this->bookingService = $bookingService;
        $this->roomService = $roomService;
    }

    public function index()
    {
        $user = Auth::user();
        $userId= $user->id;
        $userRole = $user->getRoleNames()->first();
        $bookings = $user->hasRole('hostel_manager')
            ? $this->bookingService->getBookingsByHostel($user->hostel_id)
            : $this->bookingService->getBookingsByStudent($user->id);

        return view('bookings.index', compact('bookings'));
    }
    public function getAllBookings()
    {
        $bookings = $this->bookingService->getAllBookings(); // Already paginated in BookingService
        
        return view('bookings.all', compact('bookings'));
    }
    
                
    


    public function create(Hostel $hostel)
    {
        // Get the hostel ID directly from the injected model
        $hostelId = $hostel->id;
        $hostelName = $hostel->name;
    
        // Fetch available rooms for the hostel
        $rooms = $this->roomService->getAvailableRooms($hostelId);
       $bookings = $this->bookingService->getBookingsByHostel($hostelId);    
        // Redirect if no rooms are available
        if ($rooms->isEmpty()) {
            return redirect()->route('hostels.browse')
                ->with('error', 'No available rooms found for ' . $hostelName);
        }
    
        // Return the booking creation view with available rooms
        return view('bookings.create', compact('rooms', 'hostel','bookings'));
    }
    

    public function getBookingByHostel($hostelId)
    {
        $bookings = $this->bookingService->getBookingsByHostel($hostelId);
        return view('bookings.hostel', compact('bookings'));
    }
    public function getPendingBookingsForOwnerHostels()
    {
        $bookings = $this->bookingService->getPendingBookingsForOwnerHostels();
        return view('bookings.all_pending_bookings', compact('bookings'));
    }
    public function getActiveBookingsForOwnerHostels()
    {
        $bookings = $this->bookingService->getActiveBookingsForOwnerHostels();
        return view('bookings.all_active_bookings', compact('bookings'));
    }
    public function store(BookingRequest $request)
    {
        try {
            $booking = $this->bookingService->createBooking($request->validated());
            $userRole = Auth::user()->getRoleNames()->first();
    
            if ($userRole === 'student') {
                return redirect()->route('bookings.all')
                    ->with('success', 'Booking created successfully');
            }
    
            return redirect()->route('hostels.show', $booking->hostel)
                ->with('success', 'Booking created successfully. Please proceed with the payment.');
                
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
    

    public function show($id)
    {
        $booking = $this->bookingService->findById($id);
        return view('bookings.show', compact('booking'));
    }

    public function pending()
    {
        $pendingBookings = $this->bookingService->getPendingBookings(auth()->user()->hostel_id);
        return view('bookings.pending', compact('pendingBookings'));
    }

    public function approve($id)
    {
        $booking = $this->bookingService->findById($id);
        $this->bookingService->approveBooking($booking);
        return back()->with('success', 'Booking approved successfully.');
    }

    public function reject($id)
    {
        $booking = $this->bookingService->findById($id);
        $this->bookingService->rejectBooking($booking);
        return back()->with('success', 'Booking rejected successfully.');
    }

    public function cancel($id)
    {
        $booking = $this->bookingService->findById($id);
        $this->bookingService->cancelBooking($booking);
        return back()->with('success', 'Booking cancelled successfully.');
    }
}