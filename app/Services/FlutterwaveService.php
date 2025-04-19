<?php
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class FlutterwaveService
{
    protected $publicKey;
    protected $secretKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->publicKey = config('services.flutterwave.public_key');
        $this->secretKey = config('services.flutterwave.secret_key');
        $this->baseUrl   = 'https://api.flutterwave.com/v3';
    }

    public function initializePayment(array $data)
    {
        $payload = [
            'tx_ref'        => $data['tx_ref'] ?? Str::uuid(),
            'amount'        => $data['amount'],
            'currency'      => 'UGX',
            'redirect_url'  => route('payment.callback'),
            'payment_options' => 'card,mobilemoney,ussd',
            'customer' => [
                'email' => $data['email'],
                'name'  => $data['name'] ?? 'User',
                'phone_number' => $data['phone'],
            ],
            'customizations' => [
                'title' => 'Hostel Booking Payment',
                'description' => 'Payment for hostel booking',
            ],
        ];

        $response = Http::withToken($this->secretKey)
            ->post("{$this->baseUrl}/payments", $payload);

        return $response->json();
    }

    public function verifyTransaction($transactionId)
    {
        $response = Http::withToken($this->secretKey)
            ->get("{$this->baseUrl}/transactions/{$transactionId}/verify");

        return $response->json();
    }
}
