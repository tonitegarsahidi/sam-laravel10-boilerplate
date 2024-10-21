<?php

namespace Tests\Feature;

use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SampleControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_not_logged_in_is_redirected_login_page(): void
    {
        // Arrange
        // Act
        $response1 = $this->get(route('sample.cards'));
        $response2 = $this->get(route('sample.table'));
        $response3 = $this->get(route('sample.form1'));
        $response4 = $this->get(route('sample.form2'));
        $response5 = $this->get(route('sample.textdivider'));
        $response6 = $this->get(route('sample.blank'));
        // Assert
        $response1->assertRedirect('/login'); // Check for redirect status
        $response2->assertRedirect('/login'); // Check for redirect status
        $response3->assertRedirect('/login'); // Check for redirect status
        $response4->assertRedirect('/login'); // Check for redirect status
        $response5->assertRedirect('/login'); // Check for redirect status
        $response6->assertRedirect('/login'); // Check for redirect status

    }

    public function test_user_logged_in_return_200(): void
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


        // Act
        $response1 = $this->actingAs($user)->get(route('sample.cards'));
        $response2 = $this->actingAs($user)->get(route('sample.table'));
        $response3 = $this->actingAs($user)->get(route('sample.form1'));
        $response4 = $this->actingAs($user)->get(route('sample.form2'));
        $response5 = $this->actingAs($user)->get(route('sample.textdivider'));
        $response6 = $this->actingAs($user)->get(route('sample.blank'));



        // Assert
        $response1->assertStatus(200);
        $response2->assertStatus(200);
        $response3->assertStatus(200);
        $response4->assertStatus(200);
        $response5->assertStatus(200);
        $response6->assertStatus(200);

    }
}
