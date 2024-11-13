<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

class ThankYouForVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.thank-you-verification')
                    ->subject('Thank You For Verifying Your Email Address');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
