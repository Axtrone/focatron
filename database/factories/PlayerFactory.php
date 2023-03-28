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
            'name' => fake()->lastName() . " " . fake()->firstName(),
            'number' => rand(1,100),
            'birthdate' => fake()->dateTimeBetween('-45 years', '-17  years')->format('Y-m-d')
        ];
    }
}
