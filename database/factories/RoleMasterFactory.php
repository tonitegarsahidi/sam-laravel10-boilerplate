<?php

namespace Database\Factories;

use App\Models\RoleMaster;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoleMaster>
 */
class RoleMasterFactory extends Factory
{
    protected $model = RoleMaster::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role_name' => $this->faker->word,
            'role_code' => $this->faker->unique()->word,
        ];
    }
}
