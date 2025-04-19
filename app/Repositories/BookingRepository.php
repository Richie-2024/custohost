<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BookingRepository
{
    public function getAllBookings(): Collection
    {
        return Booking::with(['hostel', 'room', 'student', 'payments'])->get();
    }

    public function getBookingsByHostel(int $hostelId): Collection
    {
        return Booking::with(['student', 'hostel', 'room']) // Ensure 'hostel' is loaded
            ->where('hostel_id', $hostelId)
            ->latest()
            ->get();
    }
    public function getBookingsByStudent(int $studentId): Collection
    {
        return Booking::with(['hostel', 'room', 'payments']) // Ensure 'hostel' is loaded
            ->where('student_id', $studentId)
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

    public function getActiveBookings(int $hostelId): Collection
    {
        return Booking::where('hostel_id', $hostelId)
            ->where('status', 'active')
            ->with(['room', 'student'])
            ->get();
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