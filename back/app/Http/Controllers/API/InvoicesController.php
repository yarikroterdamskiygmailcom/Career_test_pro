<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Customer;


class InvoicesController extends BaseController
{
    public function getInvoices(Request $request) {

        if (is_null($request->from_date)) {
            $data['from_date'] = date("Y-m-d H:i:s", strtotime('2000-01-01'));
        } else {
            $data['from_date'] = date("Y-m-d H:i:s", strtotime($request->from_date));
        }
        if (is_null($request->to_date)) {
            $data['to_date'] = date("Y-m-d H:i:s", strtotime('2150-01-01'));
        } else {
            $data['to_date'] = date("Y-m-d H:i:s", strtotime($request->to_date));
        }

        //$customers = Customer::all();
        $customers = Customer::whereBetween('created_at', [$data['from_date'], $data['to_date']])->get(['id', 'customer', 'payment_system', 'secret_link', 'created_at']);
        foreach($customers as $customer) {
            $customer->customer = json_decode(base64_decode($customer->customer), true);
        }
        return response()->json($customers, 200);
    }
}
