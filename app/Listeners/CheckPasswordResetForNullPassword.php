<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Redirect;

class CheckPasswordResetForNullPassword
{
    public function handle(PasswordReset $event)
    {
        if ($event->user->password === null) {
            // Redirect to custom view if password is null
            return Redirect::route('cannot-reset-password');
        }
    }
}
