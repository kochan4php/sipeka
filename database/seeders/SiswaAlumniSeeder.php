<?php

namespace Database\Seeders;

use App\Models\SiswaAlumni;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaAlumniSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(): void {
    SiswaAlumni::factory(50)->create();
  }
}
