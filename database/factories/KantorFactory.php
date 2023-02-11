<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kantor>
 */
class KantorFactory extends Factory {
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array {
    return [
      'alamat_kantor' => fake()->address(),
      'wilayah_kantor' => Helper::getRandomCity(),
      'status_kantor' => 'Kantor Pusat',
      'no_telp_kantor' => fake()->e164PhoneNumber()
    ];
  }
}
