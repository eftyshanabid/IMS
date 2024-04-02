<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SquareController extends Controller
{
    public function generateIdempotencyKey(){
        return \Str::random(8) . '-' . \Str::random(4) . '-' . \Str::random(4) . '-' . \Str::random(4) . '-' . time().\Str::random(2);
    }

    public function index(){
        return view('square.payment-form');
    }

    public function payWithSquare(Request $request)
    {
        $sandbox = true;
        $apiVersion = '2024-01-18';
        $locationID = 'LXJAJ9PT4BN7Z';
        $currency = 'USD';

        $afterpay_clearpay = false;
        $apple_pay = false;
        $cash_app_pay = false;
        $google_pay = false;

        $callback_url = route('square-callback');

        $accessToken = 'EAAAl4yFPaDmmQ_deeWDhiz4cLAhfLNy3K72ECoQTcv22HjxnYX20Eat3lptfE-Y';
        if($sandbox){
            //SANDBOX API ENDPOINT
            $chUrl = 'https://connect.squareupsandbox.com/v2/locations/'.$locationID.'/checkouts';
        }else{
            //PRODUCTION API ENDPOINT
            $chUrl = 'https://connect.squareup.com/v2/locations/'.$locationID.'/checkouts';
        }

        $postValues = [];
        $postValues['idempotency_key'] = $this->generateIdempotencyKey();
        $postValues['checkout_page_url'] = $callback_url;
        $postValues['redirect_url'] = $callback_url;

        $postValues['order'] = [
            'idempotency_key' => $this->generateIdempotencyKey(),
            'order' => [
                'location_id' => $locationID,
                'line_items' => [
                    [
                        'name' => $request->product_name,
                        'quantity' => $request->quantity,
                        'base_price_money' => [
                            'amount' => $request->amount * 100,
                            'currency' => $currency
                        ],
                    ]
                ],
            ],
        ];

        $postValues['checkout_options'] = [
            'accepted_payment_methods' =>
                [
                    'afterpay_clearpay' => $afterpay_clearpay,
                    'apple_pay' => $apple_pay,
                    'cash_app_pay' => $cash_app_pay,
                    'google_pay' => $google_pay,
                ],
            'redirect_url' => $callback_url
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $chUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postValues));

        $headers = [];
        $headers[] = 'Square-Version: '.$apiVersion;
        $headers[] = 'Authorization: Bearer '.$accessToken;
        $headers[] = 'Content-Type: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $err = curl_errno($ch);

        if ($err){
            return response()->json(curl_error($ch));
        }

        curl_close($ch);

        $response = json_decode($result,true);
        if(isset($response['checkout']['checkout_page_url'])){
            return redirect($response['checkout']['checkout_page_url']);
        }else{
            return response()->json($response);
        }
    }

    public function callback(Request $request){
        return $request['checkoutId'];
        //  //$request['checkoutId'] , $request['transactionId']
        dd($request->all());
        // //Transaction completed, You can add transaction details into database
    }
}
