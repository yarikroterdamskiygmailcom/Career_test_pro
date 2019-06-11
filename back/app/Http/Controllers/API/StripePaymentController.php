<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Stripe;
use Illuminate\Support\Facades\Input;
use App\Model\Customer;
use App\Model\Price;


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
        $resultData = Session::get('result');
        $customerData = json_decode(base64_decode($resultData), true);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => $customerData['price']*100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment for careertestpro PDF report"
        ]);
        Session::forget('result');
        $secretLink = md5($resultData . md5($resultData));
        $newCustomer['customer'] = $resultData;
        $newCustomer['price'] = $customerData['price'];
        $newCustomer['payment_system'] = 'stripe';
        $newCustomer['secret_link'] = $secretLink;

        $customer = Customer::create($newCustomer);
        return redirect()->route('send-pdf', array('customer_id' => $customer->id, 'result_token' => $secretLink, 'customer_email' => $customerData['email']));

        //Session::flash('success', 'Payment successful!');
        //return back();
    }
}
