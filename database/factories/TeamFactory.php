<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teamName = fake()->teamName();

        return [
            'name' => $teamName,
            'shortname' => strtoupper(substr($teamName, 0, rand(2,4))),
            'image' => fake()->imageUrl(),
        ];
    }
}
