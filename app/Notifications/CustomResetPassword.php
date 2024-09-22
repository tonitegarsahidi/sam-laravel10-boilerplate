<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class CustomResetPassword extends ResetPasswordNotification
{

    // public $connection = 'database'; // or 'redis', etc.
    public $queue = 'emails';        // specific queue name
    public $delay = 2;              // delay in seconds

    public function toMail($notifiable)
    {
        Log::debug("SENDING RESET PASSWORD using queue");
        $resetUrl = route('password.reset', ['token' => $this->token, 'email' => $notifiable->email]);

        return (new MailMessage)
        ->subject('Reset Your Password')
        ->greeting('Hello!')
        ->line('We received a request to reset your password.')
        ->action('Reset Password', $resetUrl)
        ->line('If you did not request a password reset, no further action is required.')
        ->salutation('Regards, '. config('app.name'));
    }
}
