<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPasswordNotification implements ShouldQueue
{
    public function toMail($notifiable)
    {
        $resetUrl = route('password.reset', ['token' => $this->token, 'email' => $notifiable->email]);

        return (new MailMessage)
            ->subject('Your Custom Password Reset Subject Qith Queue Email')
            ->line('We have received a request to reset your password.')
            ->action('Reset Password', $resetUrl)
            ->line('Thank you for using our application!');
    }
}
