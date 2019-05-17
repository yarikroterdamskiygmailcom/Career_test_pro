<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;
use Session;
use Helper;
use Illuminate\Support\Facades\Input;
use App\Model\Customer;
use App\Model\Price;


class MollieController extends Controller
{
    protected $price;

    public function __construct()
    {
        $this->price = Price::first();
    }

    public function preparePayment()
    {
       $resultData = Input::get('result');

        \Session::put('result', $resultData);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => number_format($this->price->value, 2) // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'My first API payments',
             //'webhookUrl' => route('order.status'),
            'redirectUrl' => route('order.success'),

        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        \Session::put('payment', $payment->id);

        //dd($payment);
        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    /**
     * After the customer has completed the transaction,
     * you can fetch, check and process the payment.
     * (See the webhook docs for more information.)
     */

    public function success() {
        $paymentId = Session::get('payment');
        $payments =  Mollie::api()->payments()->page();
        for($i = 0; $i < 50; $i++) {
            if ($payments[$i]->id == $paymentId && $payments[$i]->status == 'paid') {
                $resultData = Session::get('result');
                Session::forget('result');
                Session::forget('payment');

                $secretLink = md5($resultData . md5($resultData));
                $newCustomer['customer'] = $resultData;
                $newCustomer['price'] = $this->price->value;
                $newCustomer['payment_system'] = 'mollie';
                $newCustomer['secret_link'] = $secretLink;
                $customerData = json_decode(base64_decode($resultData), true);

                $customer = Customer::create($newCustomer);
                return redirect()->route('send-pdf', array('customer_id' => $customer->id, 'result_token' => $secretLink, 'customer_email' => $customerData['email']));
            }
        }
        return response()->json([
            'payment_status' => 'Payment failed',
        ]);
    }
}
