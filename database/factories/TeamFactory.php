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
        $teamName = fake()->unique()->city();

        return [
            'name' => $teamName,
            'shortname' => mb_strtoupper(collect(mb_str_split($teamName))->random(rand(3, (strlen($teamName) > 4 ? 4 : 3)))->implode('')),
            'image' => fake()->randomElement([fake()->randomElement(['01.png','02.png','03.png','04.png','05.png','06.png','07.png']), null]),
        ];
    }
}
