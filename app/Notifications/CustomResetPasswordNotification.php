<?php
namespace App\Notifications;

use App\Mail\CustomPasswordResetMail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends ResetPassword
{
    // Override the toMail method to send the custom email
    public function toMail($notifiable)
    {
        // Generate the password reset URL
        $url = url('/password/reset/' . $this->token . '?email=' . $notifiable->email);
        
        // Use the CustomPasswordResetMail mailable to send the email
        return (new CustomPasswordResetMail($url, $notifiable))
                ->to($notifiable->email);
    }
}