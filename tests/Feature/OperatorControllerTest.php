<?php

namespace Tests\Feature;

use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OperatorControllerTest extends TestCase
{
    use DatabaseTransactions;
/**
     * Test if a user without ROLE_OPERATOR is redirected to the home page.
     */
    public function test_user_without_operator_role_is_redirected(): void
    {
        // Arrange
        $user = User::factory()->create(); // Create a user without any role

        // Act
        $response = $this->actingAs($user)->get('/operator-page');

        // Assert
        $response->assertStatus(403); // Check for redirect status
    }

    /**
     * Test if a user with ROLE_OPERATOR can access the operator page.
     */
    public function test_operator_user_can_access_operator_page(): void
    {
        // Arrange
        $operatorRole = RoleMaster::factory()->create([
            'role_name' => 'Operator',
            'role_code' => 'ROLE_OPERATOR',
        ]);

        $operatorUser = User::factory()->create(); // Create a user
        RoleUser::factory()->create([
            'user_id' => $operatorUser->id,
            'role_id' => $operatorRole->id,
        ]);

        // Act
        $response = $this->actingAs($operatorUser)->get('/operator-page');

        // Assert
        $response->assertStatus(200);
        $response->assertSee("Hello Operator, you are a good operator, thank you");
    }
}
