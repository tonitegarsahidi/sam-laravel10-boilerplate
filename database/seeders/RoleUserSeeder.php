<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
         $roleIdSupervisor = DB::table('role_master')->where('role_code', 'ROLE_SUPERVISOR')->value('id');

         $userRoles = [
             ['user_id' => 1, 'role_id' => $roleIdUser],        // superadmin has ROLE_USER
             ['user_id' => 1, 'role_id' => $roleIdAdmin],       // superadmin has ROLE_ADMIN
             ['user_id' => 1, 'role_id' => $roleIdOperator],    // superadmin has ROLE_OPERATOR
             ['user_id' => 1, 'role_id' => $roleIdSupervisor],  // superadmin has ROLE_SUPERVISOR

             ['user_id' => 2, 'role_id' => $roleIdUser],        // admin has ROLE_USER
             ['user_id' => 2, 'role_id' => $roleIdAdmin],       // admin has ROLE_ADMIN

             ['user_id' => 3, 'role_id' => $roleIdUser],        // supervisor has ROLE_USER
             ['user_id' => 3, 'role_id' => $roleIdSupervisor],  // supervisor has ROLE_SUPERVISOR

             ['user_id' => 4, 'role_id' => $roleIdUser],        // operator has ROLE_USER
             ['user_id' => 4, 'role_id' => $roleIdOperator],    // operator has ROLE_OPERATOR

             ['user_id' => 5, 'role_id' => $roleIdUser],        // user has ROLE_USER

         ];

         DB::table('role_user')->insert($userRoles);
    }
}
