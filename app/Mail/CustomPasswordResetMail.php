<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $user;

    public function __construct($url,$user)
    {
        //
        $this->url = $url;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.custom-password-reset')
                    ->subject('Password Reset Request');
    }

    public function attachments(): array
    {
        return [];
    }
}
