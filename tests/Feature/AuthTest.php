<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

     /** @test */
     public function test_login_page_is_accessible()
     {
         $response = $this->get('/login');

         $response->assertStatus(200);
     }


     public function test_register_page_is_accessible()
     {
         $response = $this->get('/register');

         $response->assertStatus(200);
     }

     public function test_forgot_password_page_is_accessible()
     {
         $response = $this->get('/forgot-password');

         $response->assertStatus(200);
     }


    //  public function test_reset_password_page_is_accessible()
    //  {
    //      $response = $this->get('/reset-password');

    //      $response->assertStatus(200);
    //  }

    //  public function test_verify_your_email_page_is_accessible()
    //  {
    //      $response = $this->get('/verify-your-email');

    //      $response->assertStatus(200);
    //  }

    // public function test_profile_page_is_displayed(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->get('/profile');

    //     $response->assertOk();
    // }

    // public function test_profile_information_can_be_updated(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->patch('/profile', [
    //             'name' => 'Test User',
    //             'email' => 'test@example.com',
    //         ]);

    //     $response
    //         ->assertSessionHasNoErrors()
    //         ->assertRedirect('/profile');

    //     $user->refresh();

    //     $this->assertSame('Test User', $user->name);
    //     $this->assertSame('test@example.com', $user->email);
    //     $this->assertNull($user->email_verified_at);
    // }

    // public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->patch('/profile', [
    //             'name' => 'Test User',
    //             'email' => $user->email,
    //         ]);

    //     $response
    //         ->assertSessionHasNoErrors()
    //         ->assertRedirect('/profile');

    //     $this->assertNotNull($user->refresh()->email_verified_at);
    // }

    // public function test_user_can_delete_their_account(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->delete('/profile', [
    //             'password' => 'password',
    //         ]);

    //     $response
    //         ->assertSessionHasNoErrors()
    //         ->assertRedirect('/');

    //     $this->assertGuest();
    //     $this->assertNull($user->fresh());
    // }

    // public function test_correct_password_must_be_provided_to_delete_account(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->from('/profile')
    //         ->delete('/profile', [
    //             'password' => 'wrong-password',
    //         ]);

    //     $response
    //         ->assertSessionHasErrorsIn('userDeletion', 'password')
    //         ->assertRedirect('/profile');

    //     $this->assertNotNull($user->fresh());
    // }
}
