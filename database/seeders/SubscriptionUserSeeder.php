<?php

namespace Database\Seeders;

use App\Models\Saas\SubscriptionUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PDO;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubscriptionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userslist = User::latest()->take(25)->get();
        $faker = Faker::create('id_ID'); // Use 'id_ID' for Indonesian locale
        $randomName = $faker->name;


        //FREE TRIAL
        foreach($userslist as $user){
            $susbcriptionUser = [
                'user_id'   => $user->id,
                'package_id'    => 1,
                'start_date'  => $faker->dateTimeBetween('-20 months', 'now'),
                'expired_date'  => $faker->dateTimeBetween('+100 months', '+120 months'),
                'is_suspended'  => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ];

            $addedSubscription = SubscriptionUSer::create($susbcriptionUser);

            $subscriptionhistory = [
                "subscription_user_id"    => $addedSubscription->id,
                "package_price_snapshot"    => 0,
                "payment_reference"    => null,
                'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ];

            $addedSubscription = DB::table('subscription_history')->insert($subscriptionhistory);

        }

        // STANDARD PACKAGE
        $userslist = User::latest()->take(12)->get();
        $randomName = $faker->name;

        foreach($userslist as $user){
            $susbcriptionUser = [
                'user_id'   => $user->id,
                'package_id'    => 2,
                'start_date'  => $faker->dateTimeBetween('-2 months', 'now'),
                'expired_date'  => $faker->dateTimeBetween('-1 months', '+1 months'),
                'is_suspended'  => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ];

            $addedSubscription = SubscriptionUSer::create($susbcriptionUser);

            $subscriptionhistory = [
                "subscription_user_id"    => $addedSubscription->id,
                "subscription_action"    => 1,
                "package_price_snapshot"    => 150000,
                "payment_reference"    => Str::random(12),
                'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ];

            $addedSubscriptionHistory = DB::table('subscription_history')->insert($subscriptionhistory);


            $subscriptionhistory = [
                "subscription_user_id"    => $addedSubscription->id,
                "subscription_action"    => 2,
                "package_price_snapshot"    => 0,
                "payment_reference"    => Str::random(12),
                'created_at' => $faker->dateTimeBetween('-1 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 months', 'now'),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ];

            $addedSubscriptionHistory = DB::table('subscription_history')->insert($subscriptionhistory);

        }

        // ULTIMATE PACKAGE
        $userslist = User::latest()->take(5)->get();
        $randomName = $faker->name;

        foreach($userslist as $user){
            $susbcriptionUser = [
                'user_id'   => $user->id,
                'package_id'    => 4,
                'start_date'  => $faker->dateTimeBetween('-5 months', 'now'),
                'expired_date'  => $faker->dateTimeBetween('-1 months', 'now'),
                'is_suspended'  => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ];

            $addedSubscription = SubscriptionUSer::create($susbcriptionUser);

            $subscriptionhistory = [
                "subscription_user_id"    => $addedSubscription->id,
                "subscription_action"    => 1,
                "package_price_snapshot"    => 0,
                "payment_reference"    => Str::random(12),
                'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ];

            $addedSubscription = DB::table('subscription_history')->insert($subscriptionhistory);

        }
    }
}
