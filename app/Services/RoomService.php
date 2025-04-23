<?php

namespace App\Services;

use App\Models\Room;
use App\Repositories\RoomRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoomService
{
    protected $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function getAllRooms(): Collection
    {
        return $this->roomRepository->getAllRooms();
    }

    public function getRoomsByHostel(int $hostelId): Collection
    {
        return $this->roomRepository->getRoomsByHostel($hostelId);
    }

    public function getAvailableRooms(int $hostelId): Collection
    {
        return $this->roomRepository->getAvailableRooms($hostelId);
    }

    public function getPaginatedRooms(int $hostelId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->roomRepository->getPaginatedRooms($hostelId, $perPage);
    }

    public function findById(int $id): ?Room
    {
        return $this->roomRepository->findById($id);
    }

    public function createRoom(array $data): Room
    {
        $data = $this->convertAmenitiesToJson($data);

        return $this->roomRepository->create($data);
    }

    public function updateRoom(Room $room, array $data): bool
    {
        $data = $this->convertAmenitiesToJson($data);
        return $this->roomRepository->update($room, $data);
    }
    
    public function convertAmenitiesToJson(array $data): array
    {
        // Check and encode amenities if they exist and are an array
        if (!empty($data['amenities']) && is_array($data['amenities'])) {
            $data['amenities'] = json_encode($data['amenities']);
        }
    
        return $data;
    }
    
    public function deleteRoom(int $id): bool
    {
        return $this->roomRepository->delete($id);
    }

    public function updateStatus(Room $room, string $status): void
    {
        if ($status === 'maintenance' && $room->currentBooking) {
            throw new \Exception('Cannot set room to maintenance while it has an active booking.');
        }

        $this->roomRepository->updateStatus($room, $status);
    }

    public function checkAvailability(int $roomId, string $checkInDate, string $checkOutDate): bool
    {
        return $this->roomRepository->checkRoomAvailability($roomId, $checkInDate, $checkOutDate);
    }

    public function searchRooms(int $hostelId, array $criteria): Collection
    {
        return $this->roomRepository->searchRooms($hostelId, $criteria);
    }
}