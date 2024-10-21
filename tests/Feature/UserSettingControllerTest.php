<?php

namespace Tests\Feature;

use App\Helpers\ErrorHelper;
use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\User;
use App\Services\UserSettingService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mockery;
use Tests\TestCase;

class UserSettingControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * =================================================
     *      FUNCTIONS NEED TO EASE THE USUALLY
     * =================================================
     */
    private function createDummyUser($email){
        $userData = [
            'name' => 'New User '.$email,
            'email' => $email,
            'password' => Hash::make('password123'),
            'phone_number' => '08123123123',
            'is_active' => true,
        ];

        return User::create($userData);
    }

    private function createAdminUser()
    {
        // Create role for testing if not available
        $newRole = RoleMaster::factory()->create([
            'role_name' => 'admin',
            'role_code' => 'ROLE_ADMIN',
        ]);

        //Create the user
        $email = 'randomadmin@test.com';
        $newUser = $this->createDummyUser($email);

        $roleUser = RoleUser::factory()->create([
            'user_id' => $newUser->id,
            'role_id' => $newRole->id,
        ]);

        return $newUser;
    }

    private function createOperatorUser()
    {
        // Create role for testing if not available
        $role = RoleMaster::factory()->create([
            'role_name' => 'operator',
            'role_code' => 'ROLE_OPERATOR',
        ]);

        $user = $this->createDummyUser('operator@test.com', $role);

        $roleUser = RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);

        return $user;
    }

    private function createSupervisorUser()
    {
        // Create role for testing if not available
        $role = RoleMaster::factory()->create([
            'role_name' => 'supervisor',
            'role_code' => 'ROLE_SUPERVISOR',
        ]);

        $user = $this->createDummyUser('supervisor@test.com', $role);

        $roleUser = RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);

        return $user;
    }

    private function createUserUser()
    {
        // Create role for testing if not available
        $role = RoleMaster::factory()->create([
            'role_name' => 'user',
            'role_code' => 'ROLE_USER',
        ]);

        $user = $this->createDummyUser('user@test.com', $role);

        $roleUser = RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);

        return $user;
    }

    /**
     * =================================================
     *      A basic feature test example.
     * =================================================
     */
    public function test_access_user_setting_page_with_role_user_return_200(): void
    {


        $response1 = $this->actingAs($this->createAdminUser())->get(route('user.setting.index'));
        $response2 = $this->actingAs($this->createOperatorUser())->get(route('user.setting.index'));
        $response3 = $this->actingAs($this->createSupervisorUser())->get(route('user.setting.index'));
        $response4 = $this->actingAs($this->createUserUser())->get(route('user.setting.index'));

        $response1->assertStatus(200);
        $response2->assertStatus(200);
        $response3->assertStatus(200);
        $response4->assertStatus(200);
    }

    public function test_access_user_change_password_page_with_role_user_return_200(): void
    {
        $response1 = $this->actingAs($this->createAdminUser())          ->get(route('user.setting.changePassword'));
        $response2 = $this->actingAs($this->createOperatorUser())       ->get(route('user.setting.changePassword'));
        $response3 = $this->actingAs($this->createSupervisorUser())     ->get(route('user.setting.changePassword'));
        $response4 = $this->actingAs($this->createUserUser())           ->get(route('user.setting.changePassword'));
        $response1->assertStatus(200);
        $response2->assertStatus(200);
        $response3->assertStatus(200);
        $response4->assertStatus(200);
    }


     /**
     * Test successful password change for an admin user.
     */
    public function test_admin_can_change_password_successfully()
    {
        // Arrange
        $user = $this->createAdminUser(); // Create an admin user

        // Define the payload with correct current password and new password
        $payload = [
            'currentpassword'   => 'password123', // assuming this is the correct current password
            'newpassword'       => 'password345',
            'confirmnewpassword'   => 'password345'
        ];

        // Act: Perform POST request to the change password route
        $response = $this->actingAs($user)->post(route('user.setting.changePassword.do'), $payload);

        // Assert: Check redirection and session alert
        $response->assertRedirect(); // Ensure it redirects back
        $response->assertRedirectToRoute('user.setting.changePassword'); // Ensure it redirects back
        $response->assertSessionHas('alerts'); // Verify if session has alerts
        $response->assertSessionHas('alerts.0.type', 'success'); // Verify success message type
        $response->assertSessionHas('alerts.0.message', 'Your password successfully changed');
    }

    /**
     * Test Failed password change for an admin user.
     */
    public function test_admin_change_password_failed_because_of_wrong_current_password()
    {
        // Arrange
        $user = $this->createAdminUser(); // Create an admin user

        // Define the payload with correct current password and new password
        $payload = [
            'currentpassword'   => 'passwordxxx', // make the password incorrect
            'newpassword'       => 'password345',
            'confirmnewpassword'   => 'password345'
        ];

        // Act: Perform POST request to the change password route
        $response = $this->actingAs($user)->post(route('user.setting.changePassword.do'), $payload);

        // Assert: Check redirection and session alert
        $response->assertRedirect(); // Ensure it redirects back
        $response->assertRedirectToRoute('user.setting.changePassword'); // Ensure it redirects back
        $response->assertSessionHas('alerts'); // Verify if session has alerts
        $response->assertSessionHas('alerts.0.type', 'danger'); // Verify success message type
        $response->assertSessionHas('alerts.0.message', ErrorHelper::makeErrorsText('WRONG_CURRENT_PASSWORD'));
    }


    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_change_password_return_generic_exception()
    {
         // Arrange
         $user = $this->createAdminUser(); // Create an admin user

        // Mock the UserSettingService
        $mockUserSettingService = Mockery::mock(UserSettingService::class);

        // Mock the changePassword method to throw a generic exception
        $mockUserSettingService->shouldReceive('changePassword')
            ->once()
            ->andThrow(new \Exception('Something went wrong'));

        // Bind the mock to the container
        $this->app->instance(UserSettingService::class, $mockUserSettingService);

        // // Mock the log facade to expect an error to be logged
        // Log::shouldReceive('error')
        //     ->once()
        //     ->with(Mockery::on(function($message) {
        //         return strpos($message, 'Caused by Something went wrong') !== false;
        //     }));

        // // Perform the request and follow the redirect
        $response = $this->actingAs($user)->post(route('user.setting.changePassword'), [
           'currentpassword'   => 'password123', // make the password correct
            'newpassword'       => 'password345',
            'confirmnewpassword'   => 'password345'
        ]);

        // // Assert that it redirects back to the change password page
        $response->assertRedirect(route('user.setting.changePassword'));

        // // Assert that the correct error message is stored in session
        $response->assertSessionHas('alerts', function ($alerts) {
            $alert = $alerts[0];
            return $alert['type'] === 'danger' && $alert['message'] === ErrorHelper::makeErrorsText('GENERIC_ERROR');
        });
        $this->assertTrue(true);
    }


}
