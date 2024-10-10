<?php

namespace Tests\Feature;

use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test if a user without ROLE_ADMIN is redirected to the home page.
     */
    public function test_user_without_admin_role_is_redirected(): void
    {
        // Arrange
        $user = User::factory()->create(); // Create a user without any role

        // Act
        $response = $this->actingAs($user)->get('/admin-page');

        // Assert
        $response->assertStatus(403); // Check for redirect status
    }

    /**
     * Test if a user with ROLE_ADMIN can access the admin page.
     */
    public function test_admin_user_can_access_admin_page(): void
    {
        // Arrange
        $adminRole = RoleMaster::factory()->create([
            'role_name' => 'Admin',
            'role_code' => 'ROLE_ADMIN',
        ]);

        $adminUser = User::factory()->create(); // Create a user
        RoleUser::factory()->create([
            'user_id' => $adminUser->id,
            'role_id' => $adminRole->id,
        ]);

        // Act
        $response = $this->actingAs($adminUser)->get('/admin-page');

        // Assert
        $response->assertStatus(200);
        $response->assertSee("Hello Admin, this is admin page.");
    }
}
