<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Services\{BookingService, RoomService};
use Illuminate\Http\Request;

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
        $user = auth()->user();
        $bookings = $user->hasRole('hostel_manager')
            ? $this->bookingService->getBookingsByHostel($user->hostel_id)
            : $this->bookingService->getBookingsByStudent($user->id);

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $hostelId = request('hostel_id');
        $roomId = request('room_id');

        if ($roomId) {
            $rooms = collect([$this->roomService->findById($roomId)]);
        } else {
            $rooms = $this->roomService->getAvailableRooms($hostelId);
        }

        if ($rooms->isEmpty()) {
            return redirect()->route('hostels.browse')
                ->with('error', 'No available rooms found.');
        }

        return view('bookings.create', compact('rooms'));
    }

    public function store(BookingRequest $request)
    {
        try {
            $booking = $this->bookingService->createBooking($request->validated());
            return redirect()->route('bookings.show', $booking)
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