<?php

namespace Database\Seeders;

use App\Models\TingkatanPendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TingkatanPendidikanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $tingkatan_pendidikan = collect([
      [
        'id_tingkatan' => 'PDDKN001',
        'nama_tingkatan' => 'SD/MI'
      ],
      [
        'id_tingkatan' => 'PDDKN002',
        'nama_tingkatan' => 'SMP/MTS'
      ],
      [
        'id_tingkatan' => 'PDDKN003',
        'nama_tingkatan' => 'SMA/SMK'
      ],
      [
        'id_tingkatan' => 'PDDKN004',
        'nama_tingkatan' => 'D1'
      ],
      [
        'id_tingkatan' => 'PDDKN005',
        'nama_tingkatan' => 'D2'
      ],
      [
        'id_tingkatan' => 'PDDKN006',
        'nama_tingkatan' => 'D3'
      ],
      [
        'id_tingkatan' => 'PDDKN007',
        'nama_tingkatan' => 'D4'
      ],
      [
        'id_tingkatan' => 'PDDKN008',
        'nama_tingkatan' => 'S1'
      ],
      [
        'id_tingkatan' => 'PDDKN009',
        'nama_tingkatan' => 'S2'
      ],
      [
        'id_tingkatan' => 'PDDKN010',
        'nama_tingkatan' => 'S3'
      ],
    ]);

    $tingkatan_pendidikan->each(fn ($pddkn) => TingkatanPendidikan::create($pddkn));
  }
}
