<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class FakeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID'); // Use 'id_ID' for Indonesian locale

        for ($i = 0; $i < 25; $i++) {
          
             // Generate a name
            $name = faker->name();

            // Convert the name to a more email-friendly format
            $emailName = strtolower(str_replace(' ', '.', preg_replace('/[^a-zA-Z\s]/', '', $name)));

            // Combine with a domain to create the email
            $email = $emailName . '@samboilerplate.com';

            $user = User::create([
                 'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'is_active' => true,
                'email_verified_at' => Carbon::now(),
                'phone_number' => '+62'.$faker->numerify('###########'),
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
