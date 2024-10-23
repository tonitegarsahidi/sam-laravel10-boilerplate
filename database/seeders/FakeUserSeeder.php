<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FakeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 100; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'is_active' => false,
                'email_verified_at' => Carbon::now(),
                'phone_number' => '+'.fake()->numerify('##').fake()->numerify('###########'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            RoleUser::create(
                [
                    'user_id' => $user->id,
                    'role_id' => 1
                ]
                );
        }

    }
}
