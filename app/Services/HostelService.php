<?php

namespace App\Services;

use App\Models\Hostel;
use App\Repositories\HostelRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HostelService
{
    protected $hostelRepository;

    public function __construct(HostelRepository $hostelRepository)
    {
        $this->hostelRepository = $hostelRepository;
    }

    public function getAllHostels(): Collection
    {
        return $this->hostelRepository->getAllHostels();
    }

    public function getHostelsByOwner(int $ownerId): Collection
    {
        return $this->hostelRepository->getHostelsByOwner($ownerId);
    }

    public function getPaginatedHostels(int $perPage = 10): LengthAwarePaginator
    {
        return $this->hostelRepository->getPaginatedHostels($perPage);
    }

    public function findById(int $id): ?Hostel
    {
        return $this->hostelRepository->findById($id);
    }

    public function createHostel(array $data): Hostel
    {
        if (isset($data['photo'])) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
         $data['owner_id'] = Auth::id(); // Assuming the owner is the currently authenticated user
        $hostel = $this->hostelRepository->create($data);
        return $hostel;
    }

    public function updateHostel(Hostel $hostel, array $data): bool
    {
        if (isset($data['photo'])) {
            $this->deletePhoto($hostel->photo);
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
       

        return $this->hostelRepository->update($hostel, $data);
    }

    public function deleteHostel(int $id): bool
    {
        $hostel = $this->findById($id);
        $this->deletePhoto($hostel->photo);
        return $this->hostelRepository->delete($id);
    }

    public function updateAvailableRooms(Hostel $hostel): void
    {
        $this->hostelRepository->updateAvailableRooms($hostel);
    }

    public function searchHostels(string $query): Collection
    {
        return $this->hostelRepository->searchHostels($query);
    }

    protected function uploadPhoto($photo): string
    {
        $path = $photo->store('hostels', 'public');
        return $path;
    }

    protected function deletePhoto(?string $photo): void
    {
        if ($photo) {
            Storage::disk('public')->delete($photo);
        }
    }
        public static function handleFileUpload($file, $directory, $disk)
        {
            try {
                if (isset($file) && $file->isValid()) {
                    return $file->store($directory, $disk);
                }
                return null; 
            } catch (\Exception $e) {
                Log::error("File Upload Error: " . $e->getMessage());
                return null; 
            }
        }
}