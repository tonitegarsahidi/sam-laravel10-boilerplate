<?php

namespace Database\Factories;

use App\Models\Saas\SubscriptionMaster;
use App\Models\SubscriptionUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionUser>
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
        while (SubscriptionUser::where('user', $userId)->where('package', $packageId)->exists()) {
            $userId = User::inRandomOrder()->first()->id;
            $packageId = SubscriptionMaster::inRandomOrder()->first()->id;
        }

        return [
            'user' => $userId,
            'package' => $packageId,
            'start_date' => Carbon::now(),
            'expired_date' => Carbon::now()->addDays($this->faker->numberBetween(30, 365)),
            'is_suspended' => $this->faker->boolean(10), // 10% chance to be suspended
            'created_by' => $this->faker->name,
            'updated_by' => $this->faker->name,
        ];
    }
}
