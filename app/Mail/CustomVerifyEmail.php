<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('vendor.notifications.verify-email')
        ->with([
            'greeting' => 'Welcome to ' . config('app.name'),
            'introLines' => ['Please verify your email to complete the registration process.'],
            'outroLines' => ['Lets start the journey!.'],
            'actionText' => 'Verify Email',
            'actionUrl' => $this->verificationUrl(),
            'salutation' => 'Best regards',
        ]);
    }
    protected function verificationUrl()
    {
        // Generate the verification URL
        return URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $this->user->id, 'hash' => sha1($this->user->email)]
        );
    }
}
