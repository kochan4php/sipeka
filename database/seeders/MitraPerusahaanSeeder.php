<?php

namespace Database\Seeders;

use App\Models\MitraPerusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitraPerusahaanSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    MitraPerusahaan::factory(100)->hasKantor(10)->create();
  }
}
