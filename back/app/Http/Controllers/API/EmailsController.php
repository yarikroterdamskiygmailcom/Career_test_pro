<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Mail;
use App\Mail\ContactUsMail;
use Validator;


class EmailsController extends BaseController
{
    public function contactUsEmail(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        $when = now()->addSeconds(1);

        Mail::to('dmglad7@gmail.com')
            ->later($when, new ContactUsMail($request->name, $request->email, $request->message));
        return $this->sendResponse('Success', 'Email sent');

    }
}
