<?php

namespace Tests\Feature\Auth;

use App\Models\RoleMaster;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Mockery;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;
    // use Mockery;

    /** @test */
    public function user_is_auto_active_and_does_not_need_email_verification()
    {
        // Arrange
        Event::fake();
        Config::set('constant.NEW_USER_STATUS_ACTIVE', true);
        Config::set('constant.NEW_USER_NEED_VERIFY_EMAIL', false);
        $autoUserRole = config('constant.NEW_USER_DEFAULT_ROLES');

        // Create the ROLE_USER role
        // $role = RoleMaster::factory()->create(['role_code' => 'ROLE_USER']);

        // Act
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'agree' => true,
        ]);

        //retrieve the new User
        $newUser = User::where('email', 'johndoe@example.com')->first();

        // Assert
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com', 'is_active' => true]);
        $this->assertTrue(Auth::check());   //assert user is auto logged in
        $this->assertTrue($newUser->hasAnyRole([$autoUserRole]));

        Event::assertDispatched(Registered::class);
    }

    /** @test */
    public function user_register_needs_admin_activation_no_need_verify_email_and_cannot_login()
    {
        // Arrange
        Event::fake();
        Config::set('constant.NEW_USER_STATUS_ACTIVE', false);
        Config::set('constant.NEW_USER_NEED_VERIFY_EMAIL', false);
        $autoUserRole = config('constant.NEW_USER_DEFAULT_ROLES');

        // Create the ROLE_USER role
        // $role = RoleMaster::factory()->create(['role_code' => 'ROLE_USER']);

        // Act
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'agree' => true,
        ]);

        //retrieve the new User
        $newUser = User::where('email', 'johndoe@example.com')->first();

        // Assert
        $response->assertRedirect(route('register.needactivation'));
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com', 'is_active' => false]);
        $this->assertTrue($newUser->hasAnyRole([$autoUserRole]));

        //VERIFY Check that user cannot login
        $responseLogin = $this->post('/login', [
            'email' => 'johndoe@example.com',
            'password' => 'Password123',
        ]);

        // Assert: Check if the session contains the validation error (partial match)
        $responseLogin->assertSessionHasErrors('email');
            // Optionally, you can assert that the validation message contains the expected string
        $this->assertStringContainsString(
            'Yours account is not active',
            session('errors')->first('email')
        );



        Event::assertDispatched(Registered::class);
    }

    /** @test */
    public function user_register_auto_active_but_needs_to_verify_email_and_cannot_login()
    {
        // Arrange
        Event::fake();
        Config::set('constant.NEW_USER_STATUS_ACTIVE', true);
        Config::set('constant.NEW_USER_NEED_VERIFY_EMAIL', true);
        $autoUserRole = config('constant.NEW_USER_DEFAULT_ROLES');

        // Act
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'agree' => true,
        ]);


        //retrieve the new User
        $newUser = User::where('email', 'johndoe@example.com')->first();

        // Assert
        $response->assertRedirect(route('verification.notice'));
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com', 'is_active' => true, 'email_verified_at' => null]);
        $this->assertTrue($newUser->hasAnyRole([$autoUserRole]));
        $this->assertTrue(!$newUser->hasVerifiedEmail());

        //VERIFY Check that user cannot login
        $responseLogin = $this->post('/login', [
            'email' => 'johndoe@example.com',
            'password' => 'Password123',
        ]);

        // Assert: Check if the session contains the validation error (partial match)
        $responseLogin->assertSessionHasErrors('email');
            // Optionally, you can assert that the validation message contains the expected string
        $this->assertStringContainsString(
            'You need to verify your email before you can log in',
            session('errors')->first('email')
        );


        Event::assertDispatched(Registered::class);
    }

    public function testDisplayNeedActivation(){
        $response = $this->get(route('register.needactivation'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.auth.need-activation');


    }


}
