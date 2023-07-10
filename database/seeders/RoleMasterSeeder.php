<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role_name' => 'Users', 'role_code' => 'ROLE_USER'],
            ['role_name' => 'Operator', 'role_code' => 'ROLE_OPERATOR'],
            ['role_name' => 'Supervisor', 'role_code' => 'ROLE_SUPERVISOR'],
            ['role_name' => 'Administrator', 'role_code' => 'ROLE_ADMIN'],
        ];

        DB::table('role_master')->insert($roles);
    }
}
