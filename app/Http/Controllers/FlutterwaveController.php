<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FlutterwaveService;
use App\Models\User; 

use App\Models\Hostel;
use App\Models\Room;
class FlutterwaveController extends Controller
{
    protected $flutterwave;

    public function __construct(FlutterwaveService $flutterwave)
    {
        $this->flutterwave = $flutterwave;
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'installment' => 'nullable|numeric|min:1|max:' . $request->amount,
            'phone' => 'required|string|max:15',
        ]);
        
        $amount = $request->installment ?: $request->amount;
        
        $data = [
            'amount' => $amount,
            'email'  => auth()->user()->email,
            'name'   => auth()->user()->name,
            'phone'  => $request->phone, 
        ];
        
        $response = $this->flutterwave->initializePayment($data);
        
        if (isset($response['status']) && $response['status'] === 'success') {
            return redirect($response['data']['link']);
        }

        return back()->withErrors('Failed to initialize payment. Please try again.');
    }

    public function paymentCallback(Request $request)
    {
        if ($request->status !== 'successful') {
            return redirect()->route('payments.index')->with('error', 'Payment was not successful.');
        }

        $transactionId = $request->get('transaction_id');
        $verifyResponse = $this->flutterwave->verifyTransaction($transactionId);

        if (
            isset($verifyResponse['status']) &&
            $verifyResponse['status'] === 'success' &&
            $verifyResponse['data']['status'] === 'successful'
        ) {
            // Save payment in DB here, update booking status, etc.
            return redirect()->route('payments.index')->with('success', 'Payment successful!');
        }

        return redirect()->route('payments.index')->with('error', 'Payment verification failed.');
    }
}