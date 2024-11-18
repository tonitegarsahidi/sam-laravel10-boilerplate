<?php

namespace Database\Seeders;

use App\Models\Saas\SubscriptionMaster;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SubscriptionMasterSeeder extends Seeder
{
    public function run()
    {

        $faker = Faker::create('id_ID'); // Use 'id_ID' for Indonesian locale
        $randomName = $faker->name;
        $packages = [
            [
                'alias' => 'freetrial',
                'package_name' => 'Free Trial',
                'package_description' => 'Free trial for any users, and this is for 6 months! ',
                'package_price' => 0,
                'package_duration_days' => 43805,   // 10 years free trial
                'is_active' => true,
                'is_visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ],
            [
                'alias' => 'standard',
                'package_name' => 'Standard',
                'package_description' => 'A standard packet is what you need when you start in our Halokes Saas, simply basic, starter, for those who wants to experience our',
                'package_price' => 150000,
                'package_duration_days' => 30,   // 1 months years
                'is_active' => true,
                'is_visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ],
            [
                'alias' => 'ultimate',
                'package_name' => 'Ultimate',
                'package_description' => 'Dedicated server for your application, ensure performance and security since your server is your server, no one use togethers',
                'package_price' => 300000,
                'package_duration_days' => 30,
                'is_active' => true,
                'is_visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ],
            [
                'alias' => 'vvip',
                'package_name' => 'VVIP monthly',
                'package_description' => 'All you got from Ultimate plus Customer Support ',
                'package_price' => 1000000,
                'package_duration_days' => 30,
                'is_active' => false,
                'is_visible' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ],
            [
                'alias' => 'vvipannual',
                'package_name' => 'VVIP Partners',
                'package_description' => 'All you got from Ultimate plus Customer Support and paid yearly',
                'package_price' => 11000000,
                'package_duration_days' => 365,
                'is_active' => true,
                'is_visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => $randomName,
                'updated_by' => $randomName,
            ],
        ];

        DB::table('subscription_master')->insert($packages);
    }
}
