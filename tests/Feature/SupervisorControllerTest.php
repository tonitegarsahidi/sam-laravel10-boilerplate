<?php

namespace Tests\Feature;

use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupervisorControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test if a user without ROLE_SUPERVISOR is redirected to the home page.
     */
    public function test_user_without_supervisor_role_is_redirected(): void
    {
        // Arrange
        $user = User::factory()->create(); // Create a user without any role

        // Act
        $response = $this->actingAs($user)->get('/supervisor-page');

        // Assert
        $response->assertStatus(403); // Check for redirect status
    }

    /**
     * Test if a user with ROLE_SUPERVISOR can access the supervisor page.
     */
    public function test_supervisor_user_can_access_supervisor_page(): void
    {
        // Arrange
        $supervisorRole = RoleMaster::factory()->create([
            'role_name' => 'Supervisor',
            'role_code' => 'ROLE_SUPERVISOR',
        ]);

        $supervisorUser = User::factory()->create(); // Create a user
        RoleUser::factory()->create([
            'user_id' => $supervisorUser->id,
            'role_id' => $supervisorRole->id,
        ]);

        // Act
        $response = $this->actingAs($supervisorUser)->get('/supervisor-page');

        // Assert
        $response->assertStatus(200);
        $response->assertSee("Hello Supervisor, Keep being a good supervisor, thank you");
    }
}
