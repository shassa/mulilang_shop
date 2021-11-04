<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Str;


class PayPalPaymentController extends Controller
{
    public function create()
    {
        // $data = json_decode($request->getContent(), true);
        $paypalClient = new PayPalClient;
        $paypalClient->setApiCredentials(config('paypal'));
        $token = $paypalClient->getAccessToken();
        $paypalClient->setAccessToken($token);
        $order = $paypalClient->createOrder([
            "intent"=> "CAPTURE",
            "purchase_units"=> [
                 [
                    "amount"=> [
                        "currency_code"=> "USD",
                        "value"=> 20
                    ],
                     'description' => 'test'
                ]
            ],
        ]);

        return response()->json($order);
    }
    public function capture(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $orderId = $data['orderId'];
        $paypalClient = new PayPalClient;
        $paypalClient->setApiCredentials(config('paypal'));
        $token = $paypalClient->getAccessToken();
        // dd($token);
        $paypalClient->setAccessToken($token);
        // dd($paypalClient);
        $result = $paypalClient->capturePaymentOrder($orderId);

        // $result = Http::withToken($token["access_token"])->withHeaders([
        //     'Content-Type' => 'application/json',
        //     'PayPal-Request-Id'=>Str::random(20),

        //     ])->
        // post('https://www.sandbox.paypal.com/v2/checkout/orders/'.$orderId.'/capture',[
        //     'id'=>$orderId,
        // ]);
        // dd($result);

        return response()->json($result);
    }
}

