<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($url,$user)
    {
        //
        $this->url = $url;
        $this->user = $user;
    }
    public function build()
    {
        return $this->view('emails.custom-verify-email')
                    ->subject('Verify Your Email Address');
    }
    public function attachments(): array
    {
        return [];
    }
}
