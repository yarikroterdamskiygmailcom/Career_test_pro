<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Input;
use Session;
use App\Model\Testcode;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Model\Customer;
use App\Model\Price;


class TestcodesController extends BaseController
{
    protected $price;

    public function __construct()
    {
        $this->price = Price::first();
    }

    public function index() {
        $testcodes = Testcode::all();
        return $this->sendResponse($testcodes, 'Success');
    }

    public function store() {

        $voucher['value'] = md5('generate!'.mt_rand(100,999).time());
        $voucher['admin'] = Auth::user()->email;
        $newVoucher = Testcode::create($voucher);
        return $this->sendResponse($newVoucher, 'New voucher added successfully.');
    }

    public function use(Request $request) {
        $resultData = Input::get('result');
        \Session::put('result', $resultData);
        $code = Input::get('code');

        /*
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }
*/

        $getVoucher = Testcode::where('value', $code)
                                ->where('used', '0')->first();
        if(!$getVoucher)
            return $this->sendError('Invalid voucher', '', 202);

        $resultData = Session::get('result');
        Session::forget('result');

        $secretLink = md5($resultData.md5($resultData));
        $newCustomer['customer'] = $resultData;
        $newCustomer['price'] = $this->price->value;
        $newCustomer['payment_system'] = 'voucher';
        $newCustomer['secret_link'] = $secretLink;
        $customer = json_decode(base64_decode($resultData), true);
        Testcode::where('value', $code)->update(['used' => 1, 'customer' => $customer['email']]);
        $customer = Customer::create($newCustomer);
        return redirect()->route('send-pdf', array('customer_id' => $customer->id, 'result_token' => $secretLink));

    }
}
