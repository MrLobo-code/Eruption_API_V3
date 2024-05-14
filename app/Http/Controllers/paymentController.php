<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Exception;

class paymentController extends Controller
{
    public function payment(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient([
                'api_key' => env('STRIPE_SECRET')
            ]);
            $stripe->paymentIntents->create([
                'amount' => intval($request->get('amount')) * 100,
                'currency' => $request->input('currency'),
                'automatic_payment_methods' => ['enabled' => true],
            ]);
            return response()->json([
                'message' => 'Payment successful!!!',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function test1(Request $request)
    {

        $amount = $request->amount;
        $currency = $request->currency;

        return response()->json([
            'message' => $amount,
            'message2' => $currency
        ]);
    }
}
