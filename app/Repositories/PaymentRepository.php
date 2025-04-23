<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Hostel;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PaymentRepository
{
    public function getAllPayments(): Collection
    {
        return Payment::with(['booking', 'hostel'])->get();
    }


    public function getPaymentsForOwnedHostels(int $perPage=10):LengthAwarePaginator
    {
        // Get all hostel IDs owned by the authenticated user
        $hostelIds = Hostel::where('owner_id', Auth::id())->pluck('id');
    
        // Retrieve payments linked to any of the owned hostels
        $payments = Payment::whereIn('hostel_id', $hostelIds)
            ->with(['booking','hostel']) // Eager load the booking relationship
            ->paginate($perPage);
    
        return $payments;
    }
    
   

    public function getPaymentsByBooking(int $bookingId): Collection
    {
        return Payment::where('booking_id', $bookingId)
            ->with(['hostel'])
            ->get();
    }

    public function getPaginatedPayments(int $hostelId, int $perPage = 10): LengthAwarePaginator
    {
        return Payment::where('hostel_id', $hostelId)
            ->with(['booking'])
            ->orderBy('payment_date', 'desc')
            ->paginate($perPage);
    }

    public function findById(int $id): ?Payment
    {
        return Payment::with(['booking', 'hostel'])
            ->findOrFail($id);
    }

    public function create(array $data): Payment
    {
        return Payment::create($data);
    }

    public function update(Payment $payment, array $data): bool
    {
        return $payment->update($data);
    }

    public function delete(int $id): bool
    {
        return Payment::findOrFail($id)->delete();
    }

    public function updateStatus(Payment $payment, string $status): void
    {
        
        $payment->update(['status' => $status]);
    }

    public function getTotalPayments(int $hostelId): float
    {
        return Payment::where('hostel_id', $hostelId)
            ->where('status', 'completed')
            ->sum('amount');
    }
    
    public function getPaymentsByStudent($studentId)
    {
        // Replace the following line with the actual logic to fetch payments by student ID
        $bookingIds=Booking::where('student_id',Auth::id())->pluck('id');
        $payments= Payment::whereIn('booking_id', $bookingIds)->paginate(10);
    return $payments;
    }

    public function getPendingPayments(int $hostelId): Collection
    {
        return Payment::where('hostel_id', $hostelId)
            ->where('status', 'pending')
            ->with(['booking'])
            ->get();
    }
}