<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Stripe;
use Illuminate\Support\Facades\Input;


class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $resultData = Input::get('result');
        //$customerData = json_decode(base64_decode($resultData));
        //return $customerData->name;
        Session::put('result', $resultData);
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => 39.95*100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment for careertestpro PDF report"
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
