<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Helper;
use Illuminate\Support\Facades\Input;
use App\Model\Customer;
use App\Model\Price;


class BraintreeController extends Controller
{
    protected $price;

    public function __construct()
    {
        $this->price = Price::first();
    }

    public function index() {
        $resultData = Input::get('result');
        \Session::put('result', $resultData);
        return view('braintree');
    }

    public function process(Request $request)
    {
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];

        $status = \Braintree_Transaction::sale([
            'amount' => number_format($this->price->value, 2),
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        return response()->json($status);
    }

    public function success() {
        $resultData = Session::get('result');
        Session::forget('result');

        $secretLink = md5($resultData.md5($resultData));
        $newCustomer['customer'] = $resultData;
        $newCustomer['price'] = $this->price->value;
        $newCustomer['payment_system'] = 'braintree';
        $newCustomer['secret_link'] = $secretLink;

        $customer = Customer::create($newCustomer);
        return redirect()->route('send-pdf', array('customer_id' => $customer->id, 'result_token' => $secretLink));
    }
}
