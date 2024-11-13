<?php

namespace Tests\Feature;

use App\Models\RoleMaster;
use App\Models\RoleUser;
use App\Models\Saas\SubscriptionMaster;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class SubscriptionMasterControllerTest extends TestCase
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
        $newPackage = $this->createDummyUser($email);

        $roleUser = RoleUser::factory()->create([
            'user_id' => $newPackage->id,
            'role_id' => $newRole->id,
        ]);

        return $newPackage;
    }

    private function createRoleUserUser()
    {
        // Create role for testing if not available
        $newRole = RoleMaster::factory()->create([
            'role_name' => 'admin',
            'role_code' => 'ROLE_USER',
        ]);

        //Create the user
        $email = 'randomuser@test.com';
        $newUser = $this->createDummyUser($email);

        $roleUser = RoleUser::factory()->create([
            'user_id' => $newUser->id,
            'role_id' => $newRole->id,
        ]);

        return $newUser;
    }

    public function createTestPackage(){
        //ARRANGE
    $newPackageData = [
        'alias' => 'randomtestpackage',
        'package_name' => 'random test package',
        'package_description' => 'bla bla bla random package description',
        'package_price' => 200,
        'package_duration_days' => 12,
        'is_active' => false,
        'is_visible' => true,
    ];
    $newPackage = SubscriptionMaster::create($newPackageData);

    return $newPackage;

    }



    /**
     * =================================================
     *     REAL TEST UNIT FUNCTIONS IS HERE
     * =================================================
     */

    public function test_access_crudpage_without_login_redirects_to_login()
    {
        //ARRANGE
        // Create dummy package data
        SubscriptionMaster::create([
            'alias' => 'randomtestpackage',
            'package_name' => 'random test package',
            'package_description' => 'bla bla bla random package description',
            'package_price' => 200,
            'package_duration_days' => 12,
            'is_active' => false,
            'is_visible' => true,
        ]);

        //ACT
        // Perform a GET request to the index route
        $response = $this->get(route('subscription.packages.index', [
            'per_page' => 10,
            'sort_field' => 'id',
            'sort_order' => 'asc',
        ]));

        //ASSERT
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }



    public function test_access_crudpage_without_admin_role_return_403()
    {
        // Arrange
        $user = $this->createRoleUserUser();

        //ACT
        // Perform a GET request to the index route
        $responseUser = $this->actingAs($user)->get(route('subscription.packages.index', [
            'per_page' => 10,
            'sort_field' => 'id',
            'sort_order' => 'asc',
        ]));

        $responseUser->assertStatus(403);
    }

    public function test_access_crudpage_withlogin_admin_role_return_200()
    {
        // Arrange
        $user = $this->createAdminUser();

        //ACT
        // Perform a GET request to the index route
        $responseUser = $this->actingAs($user)->get(route('subscription.packages.index', [
            'per_page' => 10,
            'sort_field' => 'id',
            'sort_order' => 'asc',
        ]));

        $responseUser->assertStatus(200);
    }

    public function test_create_returns_correct_view_with_roles()
    {
        // Perform a GET request to the create route
        $response = $this->actingAs($this->createAdminUser())->get(route('subscription.packages.add'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.saas.subscriptionmaster.add');
    }

    public function test_store_redirects_on_success()
    {
        //ARRANGE
        //find current users
        $countpackages = SubscriptionMaster::count();

        //find roles
        $roles = RoleMaster::first();
        Log::debug("current user count " . $countpackages);
        // Create a new user
        $packageData = [
            'alias' => 'randomtestpackage',
            'package_name' => 'random test package',
            'package_description' => 'bla bla bla random package description',
            'package_price' => 200,
            'package_duration_days' => 12,
            'is_active' => false,
            'is_visible' => true,
        ];

        //ACT
        // Perform a POST request to the store route
        $response = $this->actingAs($this->createAdminUser())->post(route('subscription.packages.store'), $packageData);

        //ASSERT basics
        $response->assertRedirect(route('subscription.packages.index'));
        $this->assertTrue(session()->has('alerts'));

        //assert new record
        $newCountPackages = SubscriptionMaster::count();
        // Log::debug("current new user count ".$newCountUser);

        $this->assertTrue($countpackages + 1 == $newCountPackages);

        // Assert session contains 'alerts'
        $response->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response->assertSessionHas('alerts.0.type', 'success');  // check the first alert type is 'success'
        $response->assertSessionHas('sort_order', 'desc');  // check if 'sort_order' is set to 'desc'

        // Assert that the failure message "success / failed to be added" is present in the session alert message
        $response->assertSessionHas('alerts.0.message', function ($message) {
            return str_contains($message, 'successfully added');
        });
    }

    // public function test_failed_store_still_redirects_on_failure()
    // {
    //      //ARRANGE
    //     //find current users
    //     $countpackages = SubscriptionMaster::count();

    //     //find roles
    //     $roles = RoleMaster::first();
    //     Log::debug("current user count " . $countpackages);
    //     // Create a new user
    //     $packageData = [
    //         'alias' => 'randomtestpackage',
    //         'package_name' => 'random test package',
    //         'package_description' => 'bla bla bla random package description',
    //         'package_price' => 200,
    //         'package_duration_days' => 12.12,
    //         'is_active' => false,
    //         'is_visible' => true,
    //     ];

    //     //ACT
    //     // Perform a POST request to the store route
    //     $response = $this->actingAs($this->createAdminUser())->post(route('subscription.packages.store'), $packageData);

    //     //ASSERT basics
    //     $response->assertRedirect(route('subscription.packages.index'));
    //     $this->assertTrue(session()->has('alerts'));

    //     //assert new record
    //     $newCountPackages = SubscriptionMaster::count();

    //     // the number must be the same since it is the same
    //     $this->assertTrue($countpackages == $newCountPackages);

    //     // Assert session contains 'alerts'
    //     $response->assertSessionHas('alerts');  // check if 'alerts' key exists
    //     $response->assertSessionHas('alerts.0.type', 'danger');  // check the first alert type is 'danger since it is failed'
    //     $response->assertSessionHas('sort_order', 'desc');  // check if 'sort_order' is set to 'desc'

    //     // Assert that the failure message "failed to be added" is present in the session alert message
    //     $response->assertSessionHas('alerts.0.message', function ($message) {
    //         return str_contains($message, 'failed to be added');
    //     });
    // }

    public function test_access_package_detail_contain_correct_data()
    {
        //ARRANGE
        $firstPackage = SubscriptionMaster::first();

        //ACT
        $response = $this->actingAs($this->createAdminUser())->get(route('subscription.packages.detail', ["id" => $firstPackage->id]));

        //ASSERT
        $response->assertStatus(200);
        $response->assertViewIs('admin.saas.subscriptionmaster.detail');
        $response->assertSee($firstPackage->alias);
        $response->assertSee($firstPackage->package_name);
        $response->assertSee(number_format($firstPackage->package_price, 2, ',', '.'));
        $response->assertSee($firstPackage->package_description);
        $response->assertSee($firstPackage->package_duration_days);
    }

    public function test_access_package_deleteconfirm_contain_correct_data()
    {
        //ARRANGE
        //ARRANGE
        $firstPackage = SubscriptionMaster::first();

        //ACT
        $response = $this->actingAs($this->createAdminUser())->get(route('subscription.packages.delete', ["id" => $firstPackage->id]));

        //ASSERT
        $response->assertStatus(200);
        $response->assertViewIs('admin.saas.subscriptionmaster.delete-confirm');
        $response->assertSee($firstPackage->alias);
        $response->assertSee($firstPackage->package_name);
        $response->assertSee($firstPackage->package_price);
        $response->assertSee($firstPackage->package_description);
        $response->assertSee($firstPackage->package_duration_days);
    }

    public function test_delete_successfully_delete_data()
    {
        //ARRANGE
        $newPackage = $this->createTestPackage();

        $countBeforeDelete = SubscriptionMaster::count();

        //ACT
        $response = $this->actingAs($this->createAdminUser())->delete(route('subscription.packages.destroy', ["id" => $newPackage->id]));

        //ASSERT
        $response->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response->assertSessionHas('alerts.0.type', 'success');  // check the first alert type is 'danger since it is failed'

        //assert count on database
        $countAfterDelete = SubscriptionMaster::count();
        $this->assertEquals($countBeforeDelete, ($countAfterDelete + 1));

        //assert redirect to back
        $response->assertRedirect(route('subscription.packages.index'));


        //assert new user no longer exist in database
        $this->assertFalse(SubscriptionMaster::where('id', $newPackage->id)->exists());

        //assert contain alerts
        $response->assertSessionHas('alerts.0.message', function ($message) {
            return str_contains($message, 'successfully deleted');
        });
    }

    public function test_failed_delete_data_remains()
    {
        //ARRANGE
        $countBeforeDelete = SubscriptionMaster::count();

        //ACT
        $response = $this->actingAs($this->createAdminUser())->delete(route('subscription.packages.destroy', ["id" => 99999]));

        //ASSERT
        $countAfterDelete = SubscriptionMaster::count();
        $response->assertStatus(302);
        $response->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response->assertSessionHas('alerts.0.type', 'danger');  // check the first alert type is 'danger since it is failed'
        //assert redirect to back
        $response->assertRedirect(route('subscription.packages.index'));
        //assert delete user by count
        $this->assertEquals($countBeforeDelete, $countAfterDelete);

        //assert contain alerts
        $response->assertSessionHas('alerts.0.message', function ($message) {
            return str_contains($message, 'failed to be deleted');
        });
    }

    public function test_open_edit_page_contain_correct_data()
    {
        $newPackageData = $this->createTestPackage();


       //ACT
        $response = $this->actingAs($this->createAdminUser())->get(route('subscription.packages.edit', ["id" => $newPackageData->id]));


        //ASSERT
        $response->assertStatus(200);
        $response->assertViewIs('admin.saas.subscriptionmaster.edit');

        $response->assertViewHas('package');

        $response->assertSee('randomtestpackage');
        $response->assertSee('random test package');
        $response->assertSee('bla bla bla random package description');
    }

    public function test_do_edit_page_updated_data_contain_correct_data()
    {


        //create the test user
        $samplePackage = $this->createTestPackage();



        $editedPackageData = [
            'alias' => 'NEWrandomtestpackage',
            'package_name' => 'NEWrandom test package',
            'package_description' => 'NEWbla bla bla random package description',
            'package_price' => 300,
            'package_duration_days' => 15,
            'is_active' => true,
            'is_visible' => false,
        ];

       //ACT
        $response = $this->actingAs($this->createAdminUser())->put(route('subscription.packages.update', ["id" => $samplePackage->id]), $editedPackageData);

        $dataInDb = SubscriptionMaster::where('id', $samplePackage->id)->first();


        //ASSERT
        $response->assertStatus(302);
        $response->assertRedirectToRoute('subscription.packages.index');
        // Assert session contains 'alerts'
        $response->assertSessionHas('alerts');  // check if 'alerts' key exists
        $response->assertSessionHas('alerts.0.type', 'success');  // check the first alert type is 'success'
        $response->assertSessionHas('sort_order', 'desc');  // check if 'sort_order' is set to 'desc'

        // Assert that the failure message "success / failed to be updated" is present in the session alert message
        $response->assertSessionHas('alerts.0.message', function ($message) {
            return str_contains($message, 'successfully updated');
        });

        // $response->assertSee('NEWrandomtestpackage');
        $this->assertEquals($dataInDb["alias"], "NEWrandomtestpackage");


    }




}
