<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\MitraPerusahaan;
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
  public function definition() {
    return [
      'alamat_kantor' => fake()->address(),
      'wilayah_kantor' => Helper::getRandomCity(),
      'status_kantor' => 'Kantor Pusat',
      'no_telp_kantor' => fake()->e164PhoneNumber()
    ];
  }
}
