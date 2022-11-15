<?php

namespace Database\Seeders;

use App\Models\Pelamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelamarSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $pelamar = collect([
      ['id_user' => 4],
      ['id_user' => 5],
      ['id_user' => 6],
      ['id_user' => 7],
      ['id_user' => 8],
      ['id_user' => 9],
      ['id_user' => 10],
    ]);
    $pelamar->each(fn ($plmr) => Pelamar::create($plmr));
  }
}
