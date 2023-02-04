<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MitraPerusahaan>
 */
class MitraPerusahaanFactory extends Factory {
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition() {
    return [
      'id_user' => User::factory()->create(['id_level' => 'LU02']),
      'nama_perusahaan' => fake()->firstName(),
      'nomor_telp_perusahaan' => fake()->e164PhoneNumber(),
      'jenis_perusahaan' => Helper::getRandomTypeOfCompany(),
      'kategori_perusahaan' => Helper::getRandomCategoryForMitra()
    ];
  }
}
