<?php

namespace Database\Factories\Saas;

use App\Models\Saas\SubscriptionMaster;
use App\Models\Saas\SubscriptionUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Saas\SubscriptionUser>
 */
class SubscriptionUserFactory extends Factory
{
    protected $model = SubscriptionUser::class;

    public function definition(): array
    {
        // Fetch all available users and packages
        $userId = User::inRandomOrder()->first()->id;
        $packageId = SubscriptionMaster::inRandomOrder()->first()->id;

        // Ensure unique user-package combination by checking existing records
        while (SubscriptionUser::where('user_id', $userId)->where('package_id', $packageId)->exists()) {
            $userId = User::inRandomOrder()->first()->id;
            $packageId = SubscriptionMaster::inRandomOrder()->first()->id;
        }

        return [
            'user_id' => $userId,
            'package_id' => $packageId,
            'start_date' => Carbon::now()->subDays($this->faker->numberBetween(2, 30)),
            'expired_date' => Carbon::now()->addDays($this->faker->numberBetween(30, 365)),
            'is_suspended' => $this->faker->boolean(10), // 10% chance to be suspended
            'created_by' => $this->faker->name,
            'updated_by' => $this->faker->name,
        ];
    }
}
