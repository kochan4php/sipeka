<?php

namespace Database\Factories;

use App\Models\LevelUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition() {
    return [
      'id_level' => 'LU03',
      'username' => fake()->unique()->userName(),
      'email' => fake()->unique()->email(),
      'password' => bcrypt('password')
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   *
   * @return static
   */
  public function unverified() {
    return $this->state(fn (array $attributes) => [
      'email_verified_at' => null,
    ]);
  }
}
