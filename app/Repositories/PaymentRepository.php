<?php

namespace App\Repositories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentRepository
{
    public function getAllPayments(): Collection
    {
        return Payment::with(['booking', 'hostel'])->get();
    }

    public function getPaymentsByHostel(int $hostelId): Collection
    {
        return Payment::where('hostel_id', $hostelId)
            ->with(['booking'])
            ->get();
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

    public function getPendingPayments(int $hostelId): Collection
    {
        return Payment::where('hostel_id', $hostelId)
            ->where('status', 'pending')
            ->with(['booking'])
            ->get();
    }
}