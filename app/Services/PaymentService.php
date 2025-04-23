<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentService
{
    protected PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getAllPayments(): Collection
    {
        return $this->paymentRepository->getAllPayments();
    }

    public function getPaymentsForOwnedHostels()
    {
        return $this->paymentRepository->getPaymentsForOwnedHostels();
    }

    public function getPaymentsByBooking(int $bookingId): Collection
    {
        return $this->paymentRepository->getPaymentsByBooking($bookingId);
    }

    public function getPaginatedPayments(int $hostelId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->paymentRepository->getPaginatedPayments($hostelId, $perPage);
    }

    public function findPaymentById(int $id): ?Payment
    {
        return $this->paymentRepository->findById($id);
    }

    public function createPayment(array $data): Payment
    {
        return $this->paymentRepository->create($data);
    }

    public function updatePayment(Payment $payment, array $data): bool
    {
        return $this->paymentRepository->update($payment, $data);
    }

    public function deletePayment(int $id): bool
    {
        return $this->paymentRepository->delete($id);
    }

    public function updatePaymentStatus(Payment $payment, string $status): void
    {
        $this->paymentRepository->updateStatus($payment, $status);
    }

    public function getTotalPaymentsForHostel(int $hostelId): float
    {
        return $this->paymentRepository->getTotalPayments($hostelId);
    }

    public function getPendingPaymentsForHostel(int $hostelId): Collection
    {
        return $this->paymentRepository->getPendingPayments($hostelId);
    }
    public function findById($id)
    {
        return $this->paymentRepository->findById($id);
    }
    public function getPaymentsByStudent($studentId)
    {
        // Replace the following line with the actual logic to fetch payments by student ID
        return $this->paymentRepository->getPaymentsByStudent($studentId);
    }
    public function confirmPayment($payment)
    {
        return $this->paymentRepository->updateStatus($payment, 'completed');
    }
    public function getPendingPayments($hostelId)
    {
        // Replace the following line with the actual logic to fetch pending payments
        return Payment::where('hostel_id', $hostelId)->where('status', 'pending')->get();
    }
}
