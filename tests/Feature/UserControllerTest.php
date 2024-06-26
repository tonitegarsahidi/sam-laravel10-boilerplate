<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Services\UserService;

class UserControllerTest extends TestCase
{
    use RefreshDatabase; // This trait resets the database after each test

    protected function setUp(): void
    {
        parent::setUp();

        // Seed your database or create test data here if needed
    }


    /** @test */
    // public function index_returns_correct_view()
    // {
    //     $response = $this->get('/users'); // Assuming your route for the index method is /users

    //     $response->assertStatus(200);
    //     $response->assertViewIs('admin.pages.user.index'); // Replace with your actual view name
    // }

    // Write more tests for other methods like create, store, edit, update, delete, etc.
}
