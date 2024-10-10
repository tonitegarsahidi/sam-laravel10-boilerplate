<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_user_access_dashboard_without_login_redirected_to_login_page(): void
    {
        // Arrange & Act
        $response = $this->get('/dashboard');

        // Assert
        $response->assertRedirect('/login');
    }

    public function test_user_access_dashboard_with_login_return_200(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->get('/dashboard');

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.dashboard.index');
        $response->assertViewHas('user', $user);
    }
}
