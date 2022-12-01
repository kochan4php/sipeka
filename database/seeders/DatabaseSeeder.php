<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DokumenPengguna;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run(): void
  {
    $seeders = [
      LevelUserSeeder::class,
      UserSeeder::class,
      AdminBKKSeeder::class,
      // MitraPerusahaanSeeder::class,
      // PelamarSeeder::class,
      // MasyarakatSeeder::class,
      // LowonganKerjaSeeder::class,
      JurusanSeeder::class,
      AngkatanSeeder::class,
      // SiswaAlumniSeeder::class,
      // PendaftaranLowonganSeeder::class,
      // PengalamanBekerjaSeeder::class,
      DokumenSeeder::class,
      // DokumenPenggunaSeeder::class,
      // TingkatanPendidikanSeeder::class,
      // RiwayatPendidikanPenggunaSeeder::class,
      // TahapanSeleksiSeeder::class,
      // PenilaianSeleksiSeeder::class
    ];
    $this->call($seeders);
  }
}
