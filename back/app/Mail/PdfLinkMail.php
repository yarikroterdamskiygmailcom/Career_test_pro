<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PdfLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailText;
    public $userName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailTextData, $user)
    {
        $this->mailText = $mailTextData;
	$this->userName = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('develyour@gmail.com', 'Carrertest support')
            ->subject('Test result link')
            ->view('emails.pdfLink')->with('testResult',$this->mailText)->with('userName', $this->userName);
    }
}
