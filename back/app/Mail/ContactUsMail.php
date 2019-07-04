<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $mailText;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nameData, $emailData, $mailTextData)
    {
        $this->name = $nameData;
        $this->email = $emailData;
        $this->mailText = $mailTextData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from($this->email, $this->name)
            ->subject('Contact form request')
            ->view('emails.contactUs')->with('username',$this->name)
                                            ->with('useremail',$this->email)
                                            ->with('usermessage',$this->mailText);
    }
}
