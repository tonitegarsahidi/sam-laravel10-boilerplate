<?php

namespace Tests\Feature;

use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_access_adminuserindex_without_login_redirects_to_login()
    {
        // Create users
        User::factory()->count(5)->create();

        // Perform a GET request to the index route
        $response = $this->get(route('admin.user.index', [
            'per_page' => 10,
            'sort_field' => 'id',
            'sort_order' => 'asc',
        ]));

        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }

    public function test_access_adminuserindex_without_admin_role_return_403()
    {
        // Arrange

        // Create users filling
        User::factory()->count(5)->create();

        // Create role for testing
        $userRole = RoleMaster::factory()->create([
            'role_name' => 'user',
            'role_code' => 'ROLE_USER',
        ]);
        $operatorRole = RoleMaster::factory()->create([
            'role_name' => 'user',
            'role_code' => 'ROLE_OPERATOR',
        ]);
        $supervisorRole = RoleMaster::factory()->create([
            'role_name' => 'user',
            'role_code' => 'ROLE_SUPERVISOR',
        ]);

        $user = User::factory()->create(); // Create a user
        $operator = User::factory()->create(); // Create a user
        $supervisor = User::factory()->create(); // Create a user

        RoleUser::factory()->create([
            'user_id' => $user->id,
            'role_id' => $userRole->id,
        ]);

        RoleUser::factory()->create([
            'user_id' => $operator->id,
            'role_id' => $operatorRole->id,
        ]);

        RoleUser::factory()->create([
            'user_id' => $supervisor->id,
            'role_id' => $supervisorRole->id,
        ]);

        //ACT
        // Perform a GET request to the index route
        $responseUser = $this->actingAs($user)->get(route('admin.user.index', [
            'per_page' => 10,
            'sort_field' => 'id',
            'sort_order' => 'asc',
        ]));

        $responseOperator = $this->actingAs($operator)->get(route('admin.user.index', [
            'per_page' => 10,
            'sort_field' => 'id',
            'sort_order' => 'asc',
        ]));

        $responseSupervisor = $this->actingAs($supervisor)->get(route('admin.user.index', [
            'per_page' => 10,
            'sort_field' => 'id',
            'sort_order' => 'asc',
        ]));

        $responseUser->assertStatus(403);
        $responseOperator->assertStatus(403);
        $responseSupervisor->assertStatus(403);
        // $response->assertRedirectToRoute('login');
    }

    private function populateNewUser()
    {
        // Create users filling
        User::factory()->count(5)->create();
    }

    private function createAdminUser()
    {
        // Create role for testing if not available
        $adminRole = RoleMaster::factory()->create([
            'role_name' => 'admin',
            'role_code' => 'ROLE_ADMIN',
        ]);

        $adminUser = User::first(); // obtain first a user

        $roleUser = RoleUser::create([
            'user_id' => $adminUser->id,
            'role_id' => $adminRole->id,
        ]);

        return $adminUser;
    }

    private function createUserRoleUser()
    {
        // Create role for testing if not available
        $userRole = RoleMaster::factory()->create([
            'role_name' => 'user',
            'role_code' => 'ROLE_USER',
        ]);

        $user = User::first(); // obtain first a user

        $roleUser = RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $userRole->id,
        ]);

        return $user;
    }

    public function test_access_adminuserindex_with_admin_role_return_200()
    {
        // Arrange

        // Create users filling
        User::factory()->count(5)->create();

        // Create role for testing
        $adminRole = RoleMaster::factory()->create([
            'role_name' => 'admin',
            'role_code' => 'ROLE_ADMIN',
        ]);

        $adminUser = User::first(); // obtain first a user

        $roleUser = RoleUser::create([
            'user_id' => $adminUser->id,
            'role_id' => $adminRole->id,
        ]);

        //ACT
        // Perform a GET request to the index route
        $response = $this->actingAs($adminUser)->get(route('admin.user.index', [
            'per_page' => 10,
            'sort_field' => 'id',
            'sort_order' => 'asc',
        ]));

        //ASSERT
        $response->assertStatus(200);
    }

    public function test_create_returns_correct_view_with_roles()
    {
        // Perform a GET request to the create route
        $response = $this->actingAs($this->createAdminUser())->get(route('admin.user.add'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.user.add');
        $response->assertViewHas('roles');
    }

    public function test_store_redirects_on_success()
    {
        //ARRANGE
        //find current users
        $countUser = User::count();

        //find roles
        $roles = RoleMaster::first();
        Log::debug("current user count " . $countUser);
        // Create a new user
        $userData = [
            'name' => 'New Test User',
            'email' => 'randomtest@example.com',
            'password' => 'password123',
            'phone_number' => null,
            'confirmpassword' => 'password123',
            'roles' => [$roles->id],  //null
            'is_active' => true,
        ];

        //ACT
        // Perform a POST request to the store route
        $response = $this->actingAs($this->createAdminUser())->post(route('admin.user.store'), $userData);

        //ASSERT basics
        $response->assertRedirect(route('admin.user.index'));
        $this->assertTrue(session()->has('alerts'));

        //assert new record
        $newCountUser = User::count();
        // Log::debug("current new user count ".$newCountUser);

        $this->assertTrue($countUser + 1 == $newCountUser);

        // Assert session contains 'alerts'
        $response->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response->assertSessionHas('alerts.0.type', 'success');  // check the first alert type is 'success'
        $response->assertSessionHas('sort_order', 'desc');  // check if 'sort_order' is set to 'desc'

        // Assert that the failure message "success / failed to be added" is present in the session alert message
        $response->assertSessionHas('alerts.0.message', function ($message) {
            return str_contains($message, 'successfully added');
        });
    }

    public function test_failed_store_still_redirects_on_failure()
    {
        //ARRANGE
        //find current users
        $countUser = User::count();

        //find roles
        $roles = RoleMaster::first();
        Log::debug("current user count " . $countUser);
        // Create a new user
        $userData = [
            'name' => 'New Test User',
            'email' => 'randomtest@example.com',
            'password' => 'password123',
            'phone_number' => null,
            'confirmpassword' => 'password123',
            'roles' => [9999999],  //invalid role id will trigger the failure
            'is_active' => true,
        ];

        //ACT
        // Perform a POST request to the store route
        $response = $this->actingAs($this->createAdminUser())->post(route('admin.user.store'), $userData);

        //ASSERT
        $response->assertRedirect(route('admin.user.index'));
        $this->assertTrue(session()->has('alerts'));

        //assert failed new record not adding the entry
        $newCountUser = User::count();
        Log::debug("current new user count " . $newCountUser);
        $this->assertTrue($countUser == $newCountUser);

        // Assert session contains 'alerts'
        $response->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response->assertSessionHas('alerts.0.type', 'danger');  // check the first alert type is 'danger since it is failed'
        $response->assertSessionHas('sort_order', 'desc');  // check if 'sort_order' is set to 'desc'

        // Assert that the failure message "failed to be added" is present in the session alert message
        $response->assertSessionHas('alerts.0.message', function ($message) {
            return str_contains($message, 'failed to be added');
        });
    }

    public function test_access_user_detail_contain_correct_data()
    {
        //ARRANGE
        $firstUser = User::first();

        //ACT
        $response = $this->actingAs($this->createAdminUser())->get(route('admin.user.detail', ["id" => $firstUser->id]));

        //ASSERT
        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.user.detail');
        $response->assertSee($firstUser->name);
        $response->assertSee($firstUser->email);
    }

    public function test_access_user_delete_contain_correct_data()
    {
        //ARRANGE
        $firstUser = User::first();

        //ACT
        $response = $this->actingAs($this->createAdminUser())->get(route('admin.user.delete', ["id" => $firstUser->id]));

        //ASSERT
        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.user.delete-confirm');
        $response->assertSee($firstUser->name);
        $response->assertSee($firstUser->email);
    }

    public function test_delete_successfully_delete_data()
    {
        //ARRANGE
        $newUserData = [
            'name' => 'New Test User',
            'email' => 'randomtest@example.com',
            'password' => 'password123',
            'phone_number' => null,
            'confirmpassword' => 'password123',
            'roles' => [9999999],  //invalid role id will trigger the failure
            'is_active' => true,
        ];
        $newUser = User::create($newUserData);

        $countBeforeDelete = User::count();

        //ACT
        $response = $this->actingAs($this->createAdminUser())->delete(route('admin.user.destroy', ["id" => $newUser->id]));

        //ASSERT
        $response->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response->assertSessionHas('alerts.0.type', 'success');  // check the first alert type is 'danger since it is failed'

        //assert count on database
        $countAfterDelete = User::count();
        $this->assertEquals($countBeforeDelete, ($countAfterDelete + 1));

        //assert redirect to back
        $response->assertRedirect(route('admin.user.index'));


        //assert new user no longer exist in database
        $this->assertFalse(User::where('id', $newUser->id)->exists());

        //assert contain alerts
        $response->assertSessionHas('alerts.0.message', function ($message) {
            return str_contains($message, 'successfully deleted');
        });
    }

    public function test_failed_delete_data_remains()
    {
        //ARRANGE
        $countBeforeDelete = User::count();

        //ACT
        $response = $this->actingAs($this->createAdminUser())->delete(route('admin.user.destroy', ["id" => 99999]));

        //ASSERT
        $countAfterDelete = User::count();
        $response->assertStatus(302);
        $response->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response->assertSessionHas('alerts.0.type', 'danger');  // check the first alert type is 'danger since it is failed'
        //assert redirect to back
        $response->assertRedirect(route('admin.user.index'));
        //assert delete user by count
        $this->assertEquals($countBeforeDelete, $countAfterDelete);

        //assert contain alerts
        $response->assertSessionHas('alerts.0.message', function ($message) {
            return str_contains($message, 'failed to be deleted');
        });
    }

    public function test_open_edit_page_contain_correct_data()
    {
       //find roles
       $roles = RoleMaster::first();

       // Create a new user
       $userData = [
           'name' => 'New Test User',
           'email' => 'newtestuser@example.com',
           'password' => 'password123',
           'confirmpassword' => 'password123',
           'phone_number' => '1234567890',

           'roles' => [$roles->id],  //null
           'is_active' => true,
       ];

        $sampleUser = User::create($userData);


       //ACT
        $response = $this->actingAs($this->createAdminUser())->get(route('admin.user.edit', ["id" => $sampleUser->id]));


        //ASSERT
        $response->assertStatus(200);
        $response->assertViewIs('admin.pages.user.edit');
        $response->assertViewHas('user');
        $response->assertViewHas('roles');
        $response->assertSee('New Test User');
        $response->assertSee('newtestuser@example.com');
        $response->assertSee('1234567890');
    }

    public function test_do_edit_page_updated_data_contain_correct_data()
    {
       //find roles
       $originalRoles = RoleMaster::first();

       // Create a new user
       $userData = [
           'name' => 'New Test User',
           'email' => 'randomtest@example.com',
           'password' => 'password123',
           'phone_number' => null,
           'confirmpassword' => 'password123',
           'roles' => [$originalRoles->id],  //null
           'is_active' => true,
       ];

        //create the test user
        $sampleUser = User::create($userData);

        //prepare the update data payload
        //prepare the roles, we set all
        $rolesArrayId = RoleMaster::all(['id'])->pluck('id')->toArray(); ;

        Log::debug("ISINYA ROLESARRAYID" , ["rolesArrayId" => $rolesArrayId]);

        $payloadUpdatedUser = [
            'name' => 'UPDATED USER',
            'email' => 'updateduser@samboilerplate.com',
            'phone_number' => '081234567890',
            'roles' => $rolesArrayId,
            'is_active' => false,
        ];





       //ACT
        $response = $this->actingAs($this->createAdminUser())->put(route('admin.user.update', ["id" => $sampleUser->id]), $payloadUpdatedUser);


        //ASSERT
        $response->assertStatus(302);
        $response->assertRedirectToRoute('admin.user.index');
        // Assert session contains 'alerts'
        $response->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response->assertSessionHas('alerts.0.type', 'success');  // check the first alert type is 'success'
        $response->assertSessionHas('sort_order', 'desc');  // check if 'sort_order' is set to 'desc'

        // Assert that the failure message "success / failed to be updated" is present in the session alert message
        $response->assertSessionHas('alerts.0.message', function ($message) {
            return str_contains($message, 'successfully updated');
        });

        //ACT 2
        $payloadUpdatedUserFailed = [
            'name' => 'UPDATED USER',
            'email' => 'updateduser@samboilerplate.com',
            'phone_number' => '081234567890',
            'roles' => null,
            'is_active' => false,
        ];
        $response2 = $this->actingAs($this->createAdminUser())->put(route('admin.user.update', ["id" => -1]), $payloadUpdatedUserFailed);
        $response2->assertStatus(302);
        $response2->assertRedirectToRoute('admin.user.index');
        // Assert session contains 'alerts'
        $response2->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response2->assertSessionHas('alerts.0.type', 'danger');  //

    }

    function test_access_user_demo_page(){

        // Act
        $response = $this->actingAs($this->createAdminUser())->get('/user-page');

        // Assert
        $response->assertStatus(200);
        $response->assertSee("Thanks for using our products");
    }
}
