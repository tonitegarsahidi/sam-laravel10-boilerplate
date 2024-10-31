<?php

namespace Database\Factories;

use App\Models\Saas\SubscriptionMaster;
use App\Models\SubscriptionHistory;
use App\Models\SubscriptionUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionHistory>
 */
class SubscriptionHistoryFactory extends Factory
{
    protected $model = SubscriptionHistory::class;

    public function definition(): array
    {
        return [
            'subscription_user_id' => SubscriptionUser::inRandomOrder()->first()->id,
            'package_price_snapshot' => $this->faker->randomFloat(2, 10, 500),
            'payment_reference_id' => $this->faker->randomNumber(9, true), // 9-digit number for reference
            'created_by' => $this->faker->name,
            'updated_by' => $this->faker->name,
        ];
    }
}
