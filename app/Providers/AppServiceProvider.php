<?php

namespace App\Providers;

use App\Mail\CustomVerificationMail;
use Illuminate\Support\ServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Events\PasswordReset;
use App\Listeners\CheckPasswordResetForNullPassword;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{ 
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
        Toastr::useVite();
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new CustomVerificationMail($url, $notifiable))
            ->to($notifiable->email);  // Sends email to the registered user's email
        });

        Event::listen(
            PasswordReset::class,
            [CheckPasswordResetForNullPassword::class, 'handle']
        );
        
    }
}
