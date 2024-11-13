<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Verified;
use App\Mail\ThankYouForVerificationMail;
use Illuminate\Support\Facades\Mail;

class SendThankYouForVerificationEmail
{
    public function handle(Verified $event)
    {
        $user = $event->user;
        Mail::to($user->email)->send(new ThankYouForVerificationMail($user));
    }
}
