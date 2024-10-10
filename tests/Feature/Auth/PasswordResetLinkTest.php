<?php

namespace Tests\Feature\Auth;

use App\Jobs\SendResetPasswordEmailJob;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class PasswordResetLinkTest extends TestCase
{
    use DatabaseTransactions;

      /**
     * Test the password reset link request.
     */
    public function test_user_can_request_password_reset_link()
    {
        // Arrange
        Queue::fake(); // Fake the queue for the job
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        // Act
        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        // Assert
        $response->assertStatus(302); // Redirect back
        $response->assertSessionHas('status'); // Check session for success message

        // Check that the job to send the password reset email was dispatched
        Queue::assertPushed(SendResetPasswordEmailJob::class, function ($job) use ($user) {
            return $job->userId === $user->id;
        });
    }

    /**
     * Test the password reset link request fails if user does not exist.
     */
    public function test_password_reset_link_request_fails_if_user_does_not_exist()
    {
        // Arrange
        Queue::fake(); // Fake the queue for the job

        // Act
        $response = $this->post(route('password.email'), [
            'email' => 'nonexistent@example.com',
        ]);

        // Assert
        $response->assertStatus(302); // Redirect back
        $response->assertSessionHasErrors('email'); // Check for error message
        Queue::assertNothingPushed(); // Ensure no job was dispatched
    }
}
