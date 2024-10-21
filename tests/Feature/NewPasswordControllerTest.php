<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class NewPasswordControllerTest extends TestCase
{
    use DatabaseTransactions;
    public function testResetPasswordViewIsDisplayedWithToken()
    {
        // Simulate a token
        $token = 'reset-token-example';

        // Make a GET request to the reset-password route
        $response = $this->get(route('password.reset', ['token' => $token]));

        // Assert the view is correct
        $response->assertStatus(200);
        $response->assertViewIs('admin.auth.reset-password');
        $response->assertViewHas('request');
        $this->assertEquals($token, $response->viewData('request')->token);
    }

    public function testPasswordResetSuccessfully()
    {

            // Create a user
            $user = User::factory()->create([
                'email' => 'test@example.com',
                'password' => Hash::make('old-password'),
            ]);

            // Mock the Password broker to simulate successful password reset
            Password::shouldReceive('reset')
                ->once()
                ->with(
                    \Mockery::on(function ($credentials) use ($user) {
                        return $credentials['email'] === $user->email;
                    }),
                    \Mockery::on(function ($callback) use ($user) {
                        $callback($user); // Call the closure that updates the user
                        return true;
                    })
                )
                ->andReturn(Password::PASSWORD_RESET);

            // Mock the event that should be fired
            Event::fake();

            // Make a POST request to the reset-password route
            $response = $this->post(route('password.store'), [
                'email' => 'test@example.com',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
                'token' => 'reset-token-example',
            ]);

            // Assert the user is redirected to the login route
            $response->assertRedirect(route('login'));
            $response->assertSessionHas('status', trans(Password::PASSWORD_RESET));

            // Assert the user's password was updated
            $this->assertTrue(Hash::check('new-password', $user->fresh()->password));

            // Assert that the PasswordReset event was fired
            Event::assertDispatched(PasswordReset::class);
    }

    public function testPasswordResetFailsWithInvalidToken()
    {
        // Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('old-password'),
        ]);

        // Mock the Password broker to simulate a failed password reset
        Password::shouldReceive('reset')
            ->once()
            ->andReturn(Password::INVALID_TOKEN);

        // Make a POST request to the reset-password route with an invalid token
        $response = $this->post(route('password.store'), [
            'email' => 'test@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
            'token' => 'invalid-token',
        ]);

        // Assert that the user is redirected back with input and an error message
        $response->assertRedirect();
        $response->assertSessionHasErrors('email', trans(Password::INVALID_TOKEN));
    }
}
