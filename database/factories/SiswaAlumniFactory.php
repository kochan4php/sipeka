<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SiswaAlumniFactory extends Factory {
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition() {
    return [
      'id_pelamar' => \App\Models\Pelamar::factory(),
      'id_angkatan' => \App\Models\Angkatan::inRandomOrder()->first()->id_angkatan,
      'id_jurusan' => \App\Models\Jurusan::inRandomOrder()->first()->id_jurusan,
      'nis' => fake()->phoneNumber(),
      'nama_lengkap' => fake()->firstNameFemale(),
      'jenis_kelamin' => 'P',
    ];
  }
}
