<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

     /** @test */
     public function test_login_page_is_accessible()
     {
         $response = $this->get('/login');

         $response->assertStatus(200);
     }


     public function test_register_page_is_accessible()
     {
         $response = $this->get('/register');

         $response->assertStatus(200);
     }

     public function test_forgot_password_page_is_accessible()
     {
         $response = $this->get('/forgot-password');

         $response->assertStatus(200);
     }

}
