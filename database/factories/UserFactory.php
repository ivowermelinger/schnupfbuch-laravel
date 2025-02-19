<?php

namespace Database\Factories;

use App\Enums\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
	/**
	 * The current password being used by the factory.
	 */
	protected static ?string $password;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$nickname = fake()->name();

		return [
			'first_name' => fake()->firstName(),
			'last_name' => fake()->lastName(),
			'nickname' => $nickname,
			'email' => 'test@email.com',
			'email_verified_at' => now(),
			'profile_seed' => $nickname,
			'password' => static::$password ??= Hash::make('password'),
			'remember_token' => Str::random(12),
			'role' => Roles::USER,
		];
	}

	/**
	 * Indicate that the model's email address should be unverified.
	 */
	public function unverified(): static
	{
		return $this->state(fn(array $attributes) => [
			'email_verified_at' => null,
		]);
	}
}
