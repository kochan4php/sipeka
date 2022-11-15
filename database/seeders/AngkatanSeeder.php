<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AngkatanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $angkatan = collect([
      [
        'id_angkatan' => 'AGKT0001',
        'angkatan_tahun' => '2021/2022'
      ],
      [
        'id_angkatan' => 'AGKT0002',
        'angkatan_tahun' => '2022/2023'
      ],
    ]);

    $angkatan->each(fn ($agkt) => Angkatan::create($agkt));
  }
}
