<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Line>
 */
class LineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'line' => fake()->sentence(10, true),
            'likes' => fake()->numberBetween(1, 100),
            'dislikes' => fake()->numberBetween(1, 100),
            'author_id' => fake()->numberBetween(1, 5),
        ];
    }
}
