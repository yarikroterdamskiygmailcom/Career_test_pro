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
                'currency' => 'USD',
                'value' => number_format($this->price->value, 2) // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'My first API payment',
            // 'webhookUrl' => route('webhooks.mollie'),
            'redirectUrl' => route('order.success'),

        ]);

        $payment = Mollie::api()->payments()->get($payment->id);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    /**
     * After the customer has completed the transaction,
     * you can fetch, check and process the payment.
     * (See the webhook docs for more information.)
     */


    public function success() {
        $resultData = Session::get('result');
        Session::forget('result');

        $secretLink = md5($resultData.md5($resultData));
        $newCustomer['customer'] = $resultData;
        $newCustomer['price'] = $this->price->value;
        $newCustomer['payment_system'] = 'mollie';
        $newCustomer['secret_link'] = $secretLink;

        $customer = Customer::create($newCustomer);
        return redirect()->route('send-pdf', array('customer_id' => $customer->id, 'result_token' => $secretLink));
    }
}
