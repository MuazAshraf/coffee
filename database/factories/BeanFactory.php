<?php

namespace Database\Factories;

use App\Models\Bean;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bean>
 */
class BeanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->words(2, true),
            'roaster' => fake()->company(),
            'origin' => fake()->country(),
            'roast_level' => fake()->randomElement(['light', 'medium', 'dark']),
            'notes' => fake()->sentence(),
        ];
    }
}
