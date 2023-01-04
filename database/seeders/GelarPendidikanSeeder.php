<?php

namespace Database\Seeders;

use App\Models\GelarPendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GelarPendidikanSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $gelar = collect([
      ['nama_gelar' => 'SMA/SMK/SMU'],
      ['nama_gelar' => 'Associate Degree'],
      ['nama_gelar' => 'Bachelor Degree'],
      ['nama_gelar' => 'Master Degree / Post Graduate Degree'],
      ['nama_gelar' => 'Doctorate'],
    ]);
    $gelar->each(fn ($glr) => GelarPendidikan::create($glr));
  }
}
