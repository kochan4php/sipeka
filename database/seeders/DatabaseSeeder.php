<?php

declare(strict_types=1);

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
      JurusanSeeder::class,
      AngkatanSeeder::class,
      JenisPekerjaanSeeder::class,
      DokumenSeeder::class,
      GelarPendidikanSeeder::class,
      UserSeeder::class,
      AdminBKKSeeder::class,
      MitraPerusahaanSeeder::class,
      PelamarSeeder::class,
      SiswaAlumniSeeder::class,
      MasyarakatSeeder::class,
      KantorSeeder::class
    ];
    $this->call($seeders);
  }
}
