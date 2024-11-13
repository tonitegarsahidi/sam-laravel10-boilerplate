<?php

namespace Database\Factories\Saas;

use App\Models\Saas\SubscriptionMaster;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Saas\SubscriptionMaster>
 */
class SubscriptionMasterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriptionMaster::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $packageName = $this->faker->words(3, true);
        $alias = strtolower(substr(str_replace(' ', '', $packageName), 0, 10));

        return [
            'package_name' => $packageName,
            'alias' => $alias,
            'package_description' => $this->faker->words(6, true),
            'package_price' => $this->faker->randomFloat(2, 10, 500),
            'is_active' => $this->faker->boolean(90),  // 90% chance to be true
            'is_visible' => $this->faker->boolean(80), // 80% chance to be true
            'package_duration_days' => $this->faker->numberBetween(30, 365),
            'created_by' => $this->faker->name,
            'updated_by' => $this->faker->name,
        ];
    }
}
