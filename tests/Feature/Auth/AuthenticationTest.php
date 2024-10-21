<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        Config::set('constant.NEW_USER_STATUS_ACTIVE', true);
        Config::set('constant.NEW_USER_NEED_VERIFY_EMAIL', false);
        $user = User::factory()->create();
        $user->is_active = true;
        $user->save();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }


    /**
     * Test the logout functionality.
     */
    public function test_logout_functionality()
    {
        // Create a user and log them in
        $user = User::factory()->create();

        $this->actingAs($user);

        // Send a POST request to the logout route
        $response = $this->post(route('logout'));

        // Assert the response status
        $response->assertStatus(302); // Typically a redirect after logout

        // Assert that the user is logged out
        $this->assertGuest();
    }
}
