<?php

namespace Database\Seeders;

use App\Models\Saas\SubscriptionUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionUser::factory()->count(10)->create();
    }
}
