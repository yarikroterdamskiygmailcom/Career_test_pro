<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Logo;
use Validator;

class LogoController extends BaseController
{
    public function index()
    {
        $logo = Logo::first();
        return response()->json($logo, 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo_file' => 'required|image',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $file = $request->file('logo_file');
        $destinationPath = public_path('logo');
        $file->move($destinationPath, $file->getClientOriginalName());

        $logo = Logo::updateOrCreate(
            ['id' => '1'],
            ['name' => $file->getClientOriginalName()]
        );
        return $this->sendResponse('Success', 'File uploaded successfully.');

    }
}
