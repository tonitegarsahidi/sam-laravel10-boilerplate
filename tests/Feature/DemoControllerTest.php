<?php

namespace Tests\Feature;

use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DemoControllerTest extends TestCase
{

    use DatabaseTransactions;

    public function test_user_not_logged_in_is_redirected_login_page(): void
    {
        // Arrange
        // Act
        $response = $this->get('/demo');
        // Assert
        $response->assertRedirect('/login'); // Check for redirect status

        $response = $this->get('/demo/print');
        // Assert
        $response->assertRedirect('/login'); // Check for redirect status
    }

    public function test_user_without_user_role__access_demo_page_get_403(): void
    {
        // Arrange
        $user = User::factory()->create(); // Create a user without any role

        // Act
        $response = $this->actingAs($user)->get('/demo');

        // Assert
        $response->assertStatus(403); // Check for redirect status
    }

    public function test_user_without_user_role__access_demo_print_page_is_get_403(): void
    {
        // Arrange
        $user = User::factory()->create(); // Create a user without any role

        // Act
        $response = $this->actingAs($user)->get('/demo/print');

        // Assert
        $response->assertStatus(403); // Check for redirect status
    }

    /**
     * Test if a user with ROLE_USER can access the demo page.
     */
    public function test_demo_user_can_access_demo_page(): void
    {
        // Arrange
        $adminRole = RoleMaster::factory()->create([
            'role_name' => 'User',
            'role_code' => 'ROLE_USER',
        ]);

        $adminUser = User::factory()->create(); // Create a user
        RoleUser::factory()->create([
            'user_id' => $adminUser->id,
            'role_id' => $adminRole->id,
        ]);

        // Act
        $response = $this->actingAs($adminUser)->get('/demo');

        // Assert
        $response->assertStatus(200);
        $response->assertSee("Hello Demo!");
    }


    /**
     * Test if a user with ROLE_USER can access the demo page.
     */
    public function test_demo_user_can_access_demo_print_page(): void
    {
        // Arrange
        $adminRole = RoleMaster::factory()->create([
            'role_name' => 'User',
            'role_code' => 'ROLE_USER',
        ]);

        $adminUser = User::factory()->create(); // Create a user
        RoleUser::factory()->create([
            'user_id' => $adminUser->id,
            'role_id' => $adminRole->id,
        ]);

        // Act
        $response = $this->actingAs($adminUser)->get('/demo/print');

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.demo.print');
    }
}
