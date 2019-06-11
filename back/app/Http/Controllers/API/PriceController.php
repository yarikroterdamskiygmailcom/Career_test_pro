<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Price;
use Validator;

class PriceController extends BaseController
{
    public function index(Request $request)
    {
        $price = Price::where('language_id', $request->language_id)->first();
        return response()->json($price, 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'currency' => 'required|string',
            'language_id' => 'required|numeric',

        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $price = Price::updateOrCreate(
            ['language_id' => $request->language_id],
            ['value' => $request->price, 'currency' => $request->currency, 'language_id' => $request->language_id]
        );
        return $this->sendResponse('Success', 'Price modified successfully.');

    }
}
