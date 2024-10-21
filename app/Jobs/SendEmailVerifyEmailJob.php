<?php

namespace App\Jobs;

use App\Mail\CustomVerifyEmail;
use App\Models\User;
use App\Notifications\VerifyEmailWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailVerifyEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send the verification email
        // $this->user->notify(new VerifyEmailWithQueue());
        Mail::to($this->user->email)->send(new CustomVerifyEmail($this->user));
    }

    public function getUser()
    {
        return $this->user;
    }
}
