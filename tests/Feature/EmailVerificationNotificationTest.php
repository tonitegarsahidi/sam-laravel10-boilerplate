<?php

namespace Tests\Feature;

use App\Jobs\SendEmailVerifyEmailJob;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class EmailVerificationNotificationTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test GET route for email verification notification form.
     */
    public function test_show_form_returns_verification_form_view()
    {
        $response = $this->get(route('verification.sendForm'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.auth.resend-verification');
    }
    /**
     * Test POST route for sending email verification.
     */
    public function test_store_sends_email_verification_notification()
    {
        Queue::fake();

        $user = User::factory()->create([
            'email' => 'test@example.com',
            'email_verified_at' => null,
        ]);

        $response = $this->post(route('verification.send'), ['email' => $user->email]);

        $response->assertStatus(302);
        $response->assertSessionHas('status', 'Verification link sent to your email.');

        Queue::assertPushed(SendEmailVerifyEmailJob::class, function ($job) use ($user) {
            return $job->getUser()->id === $user->id;
        });
    }

    /**
     * Test POST route validation failure (invalid email).
     */
    public function test_store_fails_with_invalid_email()
    {
        $response = $this->post(route('verification.send'), ['email' => 'invalid-email']);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test email already verified scenario.
     */
    public function test_store_fails_when_email_already_verified()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'email_verified_at' => now(),
        ]);

        $response = $this->post(route('verification.send'), ['email' => $user->email]);

        $response->assertStatus(302);
        $response->assertSessionHas('status', 'Your email has already been verified, you can now login.');
    }

    /**
     * Test the verification success view.
     */
    public function test_verification_success_view()
    {
        $response = $this->get(route('verification.success'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.auth.verification-success');
    }

    /**
     * Test the verification failed view.
     */
    public function test_verification_failed_view()
    {
        $response = $this->get(route('verification.failed'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.auth.verification-failed');
    }
}
