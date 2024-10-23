<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Assign roles to users
         $roleIdUser = DB::table('role_master')->where('role_code', 'ROLE_USER')->value('id');
         $roleIdAdmin = DB::table('role_master')->where('role_code', 'ROLE_ADMIN')->value('id');
         $roleIdOperator = DB::table('role_master')->where('role_code', 'ROLE_OPERATOR')->value('id');
         $roleIdSupervisor = DB::table('role_master')->where('role_code', 'ROLE_SUPERVISOR')->value('id');// Assign roles to users

         //find the id of the users
         $userIdSuperAdmin  = DB::table('users')->where('email', 'superadmin@samboilerplate.com')->value('id');
         $userIdUser        = DB::table('users')->where('email', 'user@samboilerplate.com')->value('id');
         $userIdAdmin       = DB::table('users')->where('email', 'admin@samboilerplate.com')->value('id');
         $userIdOperator    = DB::table('users')->where('email', 'operator@samboilerplate.com')->value('id');
         $userIdSupervisor  = DB::table('users')->where('email', 'supervisor@samboilerplate.com')->value('id');



         $userRoles = [
             ['id' => Str::uuid(), 'user_id' => $userIdSuperAdmin, 'role_id' => $roleIdUser],        // superadmin has ROLE_USER
             ['id' => Str::uuid(), 'user_id' => $userIdSuperAdmin, 'role_id' => $roleIdAdmin],       // superadmin has ROLE_ADMIN
             ['id' => Str::uuid(), 'user_id' => $userIdSuperAdmin, 'role_id' => $roleIdOperator],    // superadmin has ROLE_OPERATOR
             ['id' => Str::uuid(), 'user_id' => $userIdSuperAdmin, 'role_id' => $roleIdSupervisor],  // superadmin has ROLE_SUPERVISOR

             ['id' => Str::uuid(), 'user_id' => $userIdAdmin, 'role_id' => $roleIdUser],        // admin has ROLE_USER
             ['id' => Str::uuid(), 'user_id' => $userIdAdmin, 'role_id' => $roleIdAdmin],       // admin has ROLE_ADMIN

             ['id' => Str::uuid(), 'user_id' => $userIdSupervisor, 'role_id' => $roleIdUser],        // supervisor has ROLE_USER
             ['id' => Str::uuid(), 'user_id' => $userIdSupervisor, 'role_id' => $roleIdSupervisor],  // supervisor has ROLE_SUPERVISOR

             ['id' => Str::uuid(), 'user_id' => $userIdOperator, 'role_id' => $roleIdUser],        // operator has ROLE_USER
             ['id' => Str::uuid(), 'user_id' => $userIdOperator, 'role_id' => $roleIdOperator],    // operator has ROLE_OPERATOR

             ['id' => Str::uuid(), 'user_id' => $userIdUser, 'role_id' => $roleIdUser],        // user has ROLE_USER

         ];

         DB::table('role_user')->insert($userRoles);
    }
}
