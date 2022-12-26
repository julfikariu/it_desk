<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $otp = $this->data->otp;
        $mail =  $this->from(env('MAIL_FROM_ADDRESS'),env('APP_NAME'))
            ->subject('This is a OTP Mail')
            ->view('mail.otp-mail',compact('otp'));
        return $mail;
    }
}
