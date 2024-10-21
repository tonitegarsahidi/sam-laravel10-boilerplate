<?php

namespace Tests\Feature;

use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_access_homepage_with_login_route_to_dashboard(): void
    {
        // Arrange
        $userRole = RoleMaster::factory()->create([
            'role_name' => 'User',
            'role_code' => 'ROLE_USER',
        ]);

        $user = User::factory()->create(); // Create a user
        RoleUser::factory()->create([
            'user_id' => $user->id,
            'role_id' => $userRole->id,
        ]);

        //ACT
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(302);   //redirected
        $response->assertRedirectToRoute('dashboard');
    }

}
