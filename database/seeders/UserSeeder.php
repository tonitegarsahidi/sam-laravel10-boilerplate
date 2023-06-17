<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'superadmin@halokes.my.id',
            'password' => Hash::make('password'),
            'is_active' => TRUE,
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'roles' => json_encode(['ROLE_USER', 'ROLE_ADMIN', 'ROLE_OPERATOR']),
        ]);

        DB::table('users')->insert([
            'name' => 'Sam Toni User',
            'email' => 'user@halokes.my.id',
            'password' => Hash::make('password'),
            'is_active' => TRUE,
            'email_verified_at' => Carbon::now(),
            'roles' => json_encode(['ROLE_USER']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Sam Didi Operator',
            'email' => 'operator@halokes.my.id',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'roles' => json_encode(['ROLE_OPERATOR']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Pak Bon Admin',
            'email' => 'admin@halokes.my.id',
            'password' => Hash::make('password'),
            'is_active' => TRUE,
            'email_verified_at' => Carbon::now(),
            'roles' => json_encode(['ROLE_ADMIN']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
