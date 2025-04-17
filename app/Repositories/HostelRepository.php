<?php

namespace App\Repositories;

use App\Models\Hostel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HostelRepository
{
    public function getAllHostels(): Collection
    {
        return Hostel::with(['owner', 'rooms'])->get();
    }

    public function getHostelsByOwner(int $ownerId): Collection
    {
        return Hostel::where('owner_id', $ownerId)
            ->with(['rooms', 'bookings'])
            ->get();
    }

    public function getPaginatedHostels(int $perPage = 10): LengthAwarePaginator
    {
        return Hostel::with(['owner', 'rooms'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById(int $id): ?Hostel
    {
        return Hostel::with(['owner', 'rooms', 'bookings', 'payments'])
            ->findOrFail($id);
    }

    public function create(array $data): Hostel
    {
        return Hostel::create($data);
    }

    public function update(Hostel $hostel, array $data): bool
    {
        return $hostel->update($data);
    }

    public function delete(int $id): bool
    {
        return Hostel::findOrFail($id)->delete();
    }

    public function updateAvailableRooms(Hostel $hostel): void
    {
        $availableRooms = $hostel->rooms()
            ->where('status', 'available')
            ->count();

        $hostel->update(['available_rooms' => $availableRooms]);
    }

    public function searchHostels(string $query): Collection
    {
        return Hostel::where('name', 'like', "%{$query}%")
            ->orWhere('address', 'like', "%{$query}%")
            ->with(['owner', 'rooms'])
            ->get();
    }
}