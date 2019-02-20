<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Price;
use Validator;

class PriceController extends BaseController
{
    public function index()
    {
        $price = Price::first();
        return response()->json($price, 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $price = Price::updateOrCreate(
            ['id' => '1'],
            ['value' => $request->price]
        );
        return $this->sendResponse('Success', 'Price changed successfully.');

    }
}
