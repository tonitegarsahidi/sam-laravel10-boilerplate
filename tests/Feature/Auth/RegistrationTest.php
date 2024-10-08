<?php

namespace Tests\Feature\Auth;

use App\Models\RoleMaster;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_is_auto_active_and_does_not_need_email_verification()
    {
        // Arrange
        Event::fake();
        Config::set('constant.NEW_USER_STATUS_ACTIVE', true);
        Config::set('constant.NEW_USER_NEED_VERIFY_EMAIL', false);

        // Create the ROLE_USER role
        $role = RoleMaster::factory()->create(['role_code' => 'ROLE_USER']);

        // Act
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'agree' => true,
        ]);

        // Assert
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com', 'is_active' => true]);
        $this->assertDatabaseHas('role_user', ['role_id' => $role->id]);

        Event::assertDispatched(Registered::class);
    }

    /** @test */
    public function user_needs_admin_activation()
    {
        // Arrange
        Event::fake();
        Config::set('constant.NEW_USER_STATUS_ACTIVE', false);
        Config::set('constant.NEW_USER_NEED_VERIFY_EMAIL', false);

        // Create the ROLE_USER role
        $role = RoleMaster::factory()->create(['role_code' => 'ROLE_USER']);

        // Act
        $response = $this->post('/register', [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'agree' => true,
        ]);

        // Assert
        $response->assertRedirect(route('register.needactivation'));
        $this->assertDatabaseHas('users', ['email' => 'janedoe@example.com', 'is_active' => false]);
        $this->assertDatabaseHas('role_user', ['role_id' => $role->id]);

        Event::assertDispatched(Registered::class);
    }

    /** @test */
    public function user_needs_to_verify_email()
    {
        // Arrange
        Event::fake();
        Config::set('constant.NEW_USER_STATUS_ACTIVE', true);
        Config::set('constant.NEW_USER_NEED_VERIFY_EMAIL', true);

        // Create the ROLE_USER role
        $role = RoleMaster::factory()->create(['role_code' => 'ROLE_USER']);

        // Act
        $response = $this->post('/register', [
            'name' => 'Mike Doe',
            'email' => 'mikedoe@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'agree' => true,
        ]);

        // Assert
        $response->assertRedirect(route('verification.notice'));
        $this->assertDatabaseHas('users', ['email' => 'mikedoe@example.com', 'is_active' => true]);
        $this->assertDatabaseHas('role_user', ['role_id' => $role->id]);

        Event::assertDispatched(Registered::class);
    }

    /** @test */
    public function new_user_is_assigned_default_role()
    {
        // Arrange
        Event::fake();
        Config::set('constant.NEW_USER_STATUS_ACTIVE', true);
        Config::set('constant.NEW_USER_NEED_VERIFY_EMAIL', false);

        // Create the ROLE_USER role
        $role = RoleMaster::factory()->create(['role_code' => 'ROLE_USER']);

        // Act
        $response = $this->post('/register', [
            'name' => 'Alice Doe',
            'email' => 'alicedoe@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'agree' => true,
        ]);

        // Assert
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', ['email' => 'alicedoe@example.com', 'is_active' => true]);
        $this->assertDatabaseHas('role_user', ['user_id' => User::where('email', 'alicedoe@example.com')->first()->id, 'role_id' => $role->id]);

        Event::assertDispatched(Registered::class);
    }
}
