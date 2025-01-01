<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(), // Random name
            'email' => $this->faker->unique()->safeEmail(), // Unique email
            'date_of_birth' => $this->faker->date('Y-m-d', '2005-12-31'), // Random date of birth
        ];
    }
}
