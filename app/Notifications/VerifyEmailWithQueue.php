<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmailWithQueue extends VerifyEmail
{
    // public $connection = 'database'; // Use your queue connection (database, redis, etc.)
    public $queue = 'emails'; // (Optional) Specify the queue name
    public $delay = 2;
}
