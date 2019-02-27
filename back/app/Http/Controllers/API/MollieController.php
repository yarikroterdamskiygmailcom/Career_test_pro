<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;


class MollieController extends Controller
{
    public function preparePayment()
    {
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => '10.00', // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => 'My first API payment',
            //'webhookUrl' => route('webhooks.mollie'),
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
        /*if ($payment->isPaid())
        {
            echo "Payment received.";
            // Do your thing ...
        }*/
        return redirect('welcome');
    }
}
