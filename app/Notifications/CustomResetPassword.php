<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Custom Password Reset Subject')
            ->line('We have received a request to reset your password.')
            ->action('Reset Password', url('password/reset', $this->token))
            ->line('Thank you for using our application!');
    }
}
