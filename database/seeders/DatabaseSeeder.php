<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DokumenPengguna;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run(): void {
    $seeders = [
      LevelUserSeeder::class,
      UserSeeder::class,
      AdminBKKSeeder::class,
      JurusanSeeder::class,
      AngkatanSeeder::class,
      JenisPekerjaanSeeder::class,
      DokumenSeeder::class,
      GelarPendidikanSeeder::class
    ];
    $this->call($seeders);
  }
}
