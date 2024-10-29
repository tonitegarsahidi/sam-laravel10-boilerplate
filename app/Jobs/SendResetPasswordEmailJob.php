<?php
namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class SendResetPasswordEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userId;

    /**
     * Create a new job instance.
     *
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Retrieve the user by ID
        $user = User::find($this->userId);

        if ($user) {
            $token = Password::createToken($user);

            // Send the reset password email using your CustomResetPassword notification
            $user->notify(new \App\Notifications\CustomResetPassword($token));
            Log::debug('Sending notification to user : ' . $this->userId." with token ".$token);
        } else {
            Log::error('User not found with ID: ' . $this->userId);
        }
    }

    public function failed(\Exception $exception)
    {
        // Handle failure, e.g., log the exception
        Log::error('Reset password email failed to send: ' . $exception->getMessage());
    }
}
