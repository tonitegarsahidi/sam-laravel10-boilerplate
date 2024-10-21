<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerifyEmailControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test successful email verification.
     */
    public function test_email_verification_successful()
    {
        Event::fake(); // To capture the Verified event

        // Create a user with an unverified email
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        // Generate a signed URL for email verification
        $verificationUrl = URL::signedRoute('verification.verify', [
            'id' => $user->id,
            'hash' => sha1($user->getEmailForVerification()),
        ]);

        // Send a GET request to the verification URL
        $response = $this->get($verificationUrl);

        // Assert the response redirects to the success route
        $response->assertRedirect(RouteServiceProvider::VERIFY_EMAIL_SUCCESS);

        // Assert the user's email is now marked as verified
        $this->assertTrue($user->fresh()->hasVerifiedEmail());

        // Assert a "Verified" event was dispatched
        Event::assertDispatched(Verified::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });

        // Assert session contains the success status
        $response->assertSessionHas('status', 'Email successfully verified!');
    }

    /**
     * Test email verification fails when the user does not exist.
     */
    public function test_email_verification_user_not_found()
    {
        // Generate a signed URL for a non-existent user
        $verificationUrl = URL::signedRoute('verification.verify', [
            'id' => 999,
            'hash' => sha1('non-existent@example.com'),
        ]);

        // Send a GET request to the verification URL
        $response = $this->get($verificationUrl);

        // Assert the response redirects to the verification failed route
        $response->assertRedirect(route('verification.failed'));

        // Assert the error message is returned
        $response->assertSessionHasErrors(['message' => 'User not found.']);
    }

    /**
     * Test email verification fails with an invalid hash.
     */
    public function test_email_verification_invalid_hash()
    {
        // Create a user
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        // Generate a signed URL with an invalid hash
        $invalidHashUrl = URL::signedRoute('verification.verify', [
            'id' => $user->id,
            'hash' => sha1('invalid@example.com'), // Incorrect hash
        ]);

        // Send a GET request to the URL
        $response = $this->get($invalidHashUrl);

        // Assert the response redirects to the verification failed route
        $response->assertRedirect(route('verification.failed'));

        // Assert the error message is returned
        $response->assertSessionHasErrors(['message' => 'Invalid verification link.']);
    }

    /**
     * Test email verification when the email is already verified.
     */
    public function test_email_already_verified()
    {
        // Create a user with a verified email
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        // Generate a signed URL for the user
        $verificationUrl = URL::signedRoute('verification.verify', [
            'id' => $user->id,
            'hash' => sha1($user->getEmailForVerification()),
        ]);

        // Send a GET request to the verification URL
        $response = $this->get($verificationUrl);

        // Assert the response redirects to the success route with an appropriate message
        $response->assertRedirect(RouteServiceProvider::VERIFY_EMAIL_SUCCESS);
        $response->assertSessionHas('status', 'Your email is already verified.');
    }

     /**
     * Test email verification failure redirects to failed route.
     */
    public function test_verification_failed_redirect()
    {
        // Create a user
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        // Create an invalid verification URL (simulating a bad hash or expired signature)
        $invalidUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(30),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        // Simulate visiting the invalid verification URL
        $response = $this->get($invalidUrl);

        // Assert that it redirects to the verification failed route
        $response->assertRedirect(route('verification.failed'));
        $response->assertSessionHasErrors('message', 'Email verification failed.');
    }

}
