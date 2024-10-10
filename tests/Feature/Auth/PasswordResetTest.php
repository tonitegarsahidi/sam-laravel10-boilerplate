<?php

namespace Tests\Feature\Auth;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test the password reset functionality.
     */
    public function test_user_can_reset_password()
    {
        // Arrange
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('old-password'),
        ]);

        $token = Password::createToken($user); // Create password reset token

        // Act
        $response = $this->post(route('password.store'), [
            'email' => $user->email,
            'token' => $token,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        // Assert
        $response->assertStatus(302); // Redirect to login page
        $response->assertSessionHas('status'); // Check for success message
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password)); // Assert password updated
    }

    /**
     * Test password reset fails with invalid token.
     */
    public function test_password_reset_fails_with_invalid_token()
    {
        // Arrange
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('old-password'),
        ]);

        // Act
        $response = $this->post(route('password.store'), [
            'email' => $user->email,
            'token' => 'invalid-token',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        // Assert
        $response->assertStatus(302); // Redirect back
        $response->assertSessionHasErrors('email'); // Check for error message
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password)); // Assert password not updated
    }
}
