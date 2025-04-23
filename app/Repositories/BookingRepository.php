<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Hostel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class BookingRepository
{
    public function getAllBookings()
    {
        if(Auth::user()->hasRole('student')){
            return Booking::where('student_id',Auth::id())->with(['hostel', 'room', 'student', 'payments'])->paginate(10);

        }
        return Booking::with(['hostel', 'room', 'student', 'payments'])->paginate(10);
    }
  

    public function getBookingsByHostel(int $hostelId,int $perPage=10): LengthAwarePaginator
    {
        return Booking::where('hostel_id', $hostelId)
            ->with(['room', 'student', 'payments'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getBookingsByStudent(int $studentId): Collection
    {
        return Booking::where('student_id', $studentId)
            ->with(['hostel', 'room', 'payments'])
            ->get();
    }

    public function getPaginatedBookings(int $hostelId, int $perPage = 10): LengthAwarePaginator
    {
        return Booking::where('hostel_id', $hostelId)
            ->with(['room', 'student', 'payments'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById(int $id): ?Booking
    {
        return Booking::with(['hostel', 'room', 'student', 'payments'])
            ->findOrFail($id);
    }

    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function update(Booking $booking, array $data): bool
    {
        return $booking->update($data);
    }

    public function delete(int $id): bool
    {
        return Booking::findOrFail($id)->delete();
    }

    public function updateStatus(Booking $booking, string $status): void
    {
        $booking->update(['status' => $status]);
    }

    public function getActiveBookings()
    {
        if(Auth::user()->hasRole('hostel_manager')){

        // Get all hostel IDs owned by the authenticated user
        $hostelIds = Hostel::where('owner_id', Auth::id())->pluck('id');
        // Ensure the requested hostel ID is part of the owned hostels
        if (!$hostelIds) {
            return collect(); // Return an empty collection if the hostel is not owned by the user
        }
    
        // Retrieve active bookings for the specific hostel
        $bookings = Booking::whereIn('hostel_id', $hostelIds)
            ->whereIn('status', ['active', 'confirmed', 'completed'])
            ->with(['room', 'student']) // Eager load relationships
            ->get();
    }else{
        $bookings=Booking::where('student_id',Auth::id())->whereIn('status',['active','confirmed','completed'])->with(['room','student'])->get();
    }
        return $bookings;
    }
    public function getPendingBookingsForOwnerHostels($perPage = 10):LengthAwarePaginator
    {
        // Get all hostel IDs owned by the authenticated user
        $hostelIds = Hostel::where('owner_id', Auth::id())->pluck('id');
        // Ensure the requested hostel ID is part of the owned hostels
        if (!$hostelIds) {
            return collect()->paginate($perPage); // Return an empty collection if the hostel is not owned by the user
        }
    
        // Retrieve active bookings for the specific hostel
        $bookings = Booking::whereIn('hostel_id', $hostelIds)
            ->whereIn('status', ['pending'])
            ->with(['room', 'student']) // Eager load relationships
            ->paginate($perPage);
        return $bookings;
    }
    public function getActiveBookingsForOwnerHostels($perPage = 10):LengthAwarePaginator
    {
        // Get all hostel IDs owned by the authenticated user
        $hostelIds = Hostel::where('owner_id', Auth::id())->pluck('id');
        // Ensure the requested hostel ID is part of the owned hostels
        if (!$hostelIds) {
            return collect()->paginate($perPage); // Return an empty collection if the hostel is not owned by the user
        }
    
        // Retrieve active bookings for the specific hostel
        $bookings = Booking::whereIn('hostel_id', $hostelIds)
            ->whereIn('status', ['pending'])
            ->with(['room', 'student']) // Eager load relationships
            ->paginate($perPage);
        return $bookings;
    }

    public function getPendingBookings(int $hostelId): Collection
    {
        return Booking::where('hostel_id', $hostelId)
            ->where('status', 'pending')
            ->with(['room', 'student'])
            ->get();
    }

    public function checkRoomAvailability(int $roomId, string $checkInDate, string $checkOutDate): bool
    {
        return !Booking::where('room_id', $roomId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate]);
            })
            ->exists();
    }
}