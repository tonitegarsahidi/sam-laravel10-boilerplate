<?php

namespace Database\Seeders;

use App\Models\Saas\SubscriptionMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionMasterSeeder extends Seeder
{
    public function run()
    {
        // Generate 10 subscription packages
        SubscriptionMaster::factory()->count(10)->create();
    }
}
