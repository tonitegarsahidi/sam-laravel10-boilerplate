<?php

namespace Tests\Feature;

use App\Jobs\SendResetPasswordEmailJob;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\TestCase;

class PasswordResetLinkControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_forgot_password_page_is_displayed()
{
    $response = $this->get(route('password.request'));

    $response->assertStatus(200);
    $response->assertViewIs('admin.auth.forgot-password');
}

public function testPasswordResetLinkIsSentForValidEmail()
{
    // Create a fake user
    $user = User::factory()->create([
        'email' => 'test@example.com',
    ]);

    // Mock the queue and log
    Queue::fake();
    Log::shouldReceive('debug')->once()->with('Dispatching the Jobs');

    // Make the request
    $response = $this->post(route('password.email'), [
        'email' => 'test@example.com',
    ]);

    // Assert that the job was dispatched
    Queue::assertPushed(SendResetPasswordEmailJob::class, function ($job) use ($user) {
        return $job->userId === $user->id;
    });

    // Assert redirection and status message
    $response->assertRedirect();
    $response->assertSessionHas('status', 'We have emailed your password reset link! to test@example.com');
}

public function testInvalidEmailFormatReturnsValidationError()
{
    $response = $this->post(route('password.email'), [
        'email' => 'invalid-email',
    ]);

    $response->assertSessionHasErrors('email');
}

public function testSendResetPasswordEmailJobFailsGracefully()
{
    $user = User::factory()->create();

    // Mock the logger to expect an error message
    Log::shouldReceive('error')->once()->with('Reset password email failed to send: Exception message');

    // Simulate an exception
    $job = new SendResetPasswordEmailJob($user->id);
    $job->failed(new \Exception('Exception message'));
}


public function testSendResetPasswordEmailJobExecutesCorrectly()
{
    // Fake the notification
    Notification::fake();

    // Create a fake user
    $user = User::factory()->create();

    // Mock the Password facade to return a specific token
    Password::shouldReceive('createToken')
        ->once()
        ->with(Mockery::on(function ($argument) use ($user) {
            // Match the User instance by comparing their ID
            return $argument->id === $user->id;
        }))
        ->andReturn('reset-token');

    // Mock the Log facade to expect the debug message
    Log::shouldReceive('debug')
        ->once()
        ->with('Sending notification to user : ' . $user->id . ' with token reset-token');

    // Dispatch the job and call handle method manually
    $job = new SendResetPasswordEmailJob($user->id);
    $job->handle();

    // Assert that the notification was sent
    Notification::assertSentTo(
        [$user], \App\Notifications\CustomResetPassword::class, function ($notification, $channels) use ($user) {
            return $notification->token === 'reset-token';
        }
    );
}


public function testPasswordResetFailsForNonExistentEmail()
{
    // Fake the queue
    Queue::fake();
    // Make the request with a non-existent email
    $response = $this->post(route('password.email'), [
        'email' => 'nonexistent@example.com',
    ]);

    // Assert that no job was dispatched
    Queue::assertNothingPushed();

    // Assert error message
    $response->assertRedirect();
    $response->assertSessionHasErrors('email', 'No user found with this email.');
}



}
