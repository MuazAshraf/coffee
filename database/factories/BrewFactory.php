<?php

namespace Database\Factories;

use App\Models\Bean;
use App\Models\Brew;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brew>
 */
class BrewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'bean_id' => Bean::factory(),
            'method' => fake()->randomElement(['v60', 'aeropress', 'espresso', 'french_press', 'chemex']),
            'dose_grams' => fake()->randomFloat(2, 12, 22),
            'yield_grams' => fake()->randomFloat(2, 30, 360),
            'brew_time_seconds' => fake()->numberBetween(25, 300),
            'grind_setting' => (string) fake()->numberBetween(1, 40),
            'water_temp_c' => fake()->randomFloat(1, 88, 96),
            'taste_notes' => fake()->sentence(),
            'rating' => fake()->numberBetween(1, 5),
            'brewed_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
