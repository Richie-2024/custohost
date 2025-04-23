<?php

namespace App\Repositories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoomRepository
{
    public function getAllRooms(): Collection
    {
        return Room::with(['hostel', 'bookings'])->get();
    }

    public function getRoomsByHostel(int $hostelId): Collection
    {
        return Room::where('hostel_id', $hostelId)
            ->with(['bookings'])
            ->get();
    }

    public function getAvailableRooms(int $hostelId): Collection
    {
        return Room::where('hostel_id', $hostelId)
            ->where('status', 'available')
            ->get();
    }

    public function getPaginatedRooms(int $hostelId, int $perPage = 10): LengthAwarePaginator
    {
        return Room::where('hostel_id', $hostelId)
            ->with(['bookings'])
            ->orderBy('room_number')
            ->paginate($perPage);
    }

    public function findById(int $id): ?Room
    {
        return Room::with(['hostel', 'bookings', 'currentBooking'])
            ->findOrFail($id);
    }

    public function create(array $data): Room
    {
    
        return Room::create($data);
    }
    

    public function update(Room $room, array $data): bool
    {
    
        return $room->update($data);
    }

    public function delete(int $id): bool
    {
        return Room::findOrFail($id)->delete();
    }

    public function updateStatus(Room $room, string $status): void
    {
        $room->update(['status' => $status]);
    }

    public function searchRooms(int $hostelId, array $criteria): Collection
    {
        return Room::where('hostel_id', $hostelId)
            ->when(isset($criteria['type']), function ($query) use ($criteria) {
                return $query->where('type', $criteria['type']);
            })
            ->when(isset($criteria['capacity']), function ($query) use ($criteria) {
                return $query->where('capacity', '>=', $criteria['capacity']);
            })
            ->when(isset($criteria['max_price']), function ($query) use ($criteria) {
                return $query->where('price', '<=', $criteria['max_price']);
            })
            ->when(isset($criteria['status']), function ($query) use ($criteria) {
                return $query->where('status', $criteria['status']);
            })
            ->get();
    }
    public function checkRoomAvailability(int $roomId, string $checkInDate, string $checkOutDate): bool
    {
        // Example logic to check room availability
        $room = Room::find($roomId);

        if (!$room) {
            return false;
        }

        $conflictingBookings = $room->bookings()
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                      ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                      ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$checkInDate])
                      ->orWhereRaw('? BETWEEN check_in_date AND check_out_date', [$checkOutDate]);
            })
            ->exists();

        return !$conflictingBookings;
    }
}