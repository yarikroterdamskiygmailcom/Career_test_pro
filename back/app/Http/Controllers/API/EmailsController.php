<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Mail;
use App\Mail\ContactUsMail;
use App\Mail\PdfLinkMail;
use Illuminate\Support\Facades\Input;

use Validator;


class EmailsController extends BaseController
{
    protected $when;
    protected $receiver;

    public function __construct()
    {
        $this->receiver = 'yarik.roterdamskiy@gmail.com';
        $this->when = now()->addSeconds(1);
    }

    public function contactUsEmail(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 202);
        }

        Mail::to($this->receiver)
            ->later($this->when, new ContactUsMail($request->name, $request->email, $request->message));
        return $this->sendResponse('Success', 'Email sent');

    }

    public function pdfLinkEmail() {
        $when = now()->addSeconds(1);

 /*       Mail::send('emails.pdfLink', ['user' => '111'], function ($message) {
            $message->from('us@example.com', 'Laravel');

            $message->to(Input::get('customer_email'));
        });
*/
        Mail::to(Input::get('customer_email'))
            ->later($this->when, new PdfLinkMail('http://backcartestpro.qbex.io/api/diagrams/'.Input::get('customer_id').'?result_key='.Input::get('result_token')));

        return redirect('http://cartestpro.qbex.io/final');

    }
}
