<?php

namespace Database\Seeders;

use App\Models\LevelUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelUserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $levelUser = collect([
      [
        'id_level' => 'LU01',
        'nama_level' => 'Admin BKK'
      ],
      [
        'id_level' => 'LU02',
        'nama_level' => 'Mitra Perusahaan'
      ],
      [
        'id_level' => 'LU03',
        'nama_level' => 'Pelamar'
      ],
    ]);

    $levelUser->each(fn ($lu) => LevelUser::create($lu));
  }
}
