<?php

namespace Database\Factories;

use App\Models\User;
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
			'likes' => 0,
			'dislikes' => 0,
			'active' => false,
			'user_id' => User::inRandomOrder()->first()->id
		];
	}
}
