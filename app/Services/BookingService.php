<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Room;
use App\Repositories\BookingRepository;
use App\Repositories\RoomRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class BookingService
{
    protected $bookingRepository;
    protected $roomRepository;

    public function __construct(
        BookingRepository $bookingRepository,
        RoomRepository $roomRepository
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->roomRepository = $roomRepository;
    }

    public function getAllBookings()
    {
        return $this->bookingRepository->getAllBookings();
    }

    public function getBookingsByHostel(int $hostelId)
    {
        return $this->bookingRepository->getBookingsByHostel($hostelId);
    }

    public function getBookingsByStudent(int $studentId): Collection
    {
        return $this->bookingRepository->getBookingsByStudent($studentId);
    }

    public function getPaginatedBookings(int $hostelId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->bookingRepository->getPaginatedBookings($hostelId, $perPage);
    }

    public function findById(int $id): ?Booking
    {
        return $this->bookingRepository->findById($id);
    }

    public function createBooking(array $data): Booking
    {
        // Validate room availability
        $isAvailable = $this->bookingRepository->checkRoomAvailability(
            $data['room_id'],
            $data['check_in_date'],
            $data['check_out_date']
        );

        if (!$isAvailable) {
            throw new \Exception('Room is not available for the selected dates.');
        }

        // Calculate total amount
        $room = $this->roomRepository->findById($data['room_id']);
        $checkIn = Carbon::parse($data['check_in_date']);
        $checkOut = Carbon::parse($data['check_out_date']);
        $days = $checkIn->diffInDays($checkOut);
        $data['total_amount'] = $room->price * $days;

        // Create booking
        $booking = $this->bookingRepository->create($data);

        // Update room status
        $this->roomRepository->updateStatus($room, 'occupied');

        return $booking;
    }

    public function updateBooking(Booking $booking, array $data): bool
    {
        if (isset($data['check_in_date']) || isset($data['check_out_date'])) {
            $isAvailable = $this->bookingRepository->checkRoomAvailability(
                $booking->room_id,
                $data['check_in_date'] ?? $booking->check_in_date,
                $data['check_out_date'] ?? $booking->check_out_date
            );

            if (!$isAvailable) {
                throw new \Exception('Room is not available for the selected dates.');
            }
        }

        return $this->bookingRepository->update($booking, $data);
    }

    public function cancelBooking(Booking $booking): void
    {
        $this->bookingRepository->updateStatus($booking, 'cancelled');
        $this->roomRepository->updateStatus($booking->room, 'available');
    }

    public function completeBooking(Booking $booking): void
    {
        $this->bookingRepository->updateStatus($booking, 'completed');
        $this->roomRepository->updateStatus($booking->room, 'available');
    }
    public function approveBooking(Booking $booking)
    {
        $booking->status = 'confirmed';
        $booking->save();
    }
    public function rejectBooking(Booking $booking)
    {
        $booking->status = 'cancelled';
        $booking->save();
    }

    public function getActiveBookings()
    {
        return $this->bookingRepository->getActiveBookings();
    }
    public function getPendingBookingsForOwnerHostels(): LengthAwarePaginator
    {
        return $this->bookingRepository->getPendingBookingsForOwnerHostels();
    }
    public function getActiveBookingsForOwnerHostels()
    {
        return $this->bookingRepository->getActiveBookingsForOwnerHostels();
    }

    public function getPendingBookings(int $hostelId): Collection
    {
        return $this->bookingRepository->getPendingBookings($hostelId);
    }
}