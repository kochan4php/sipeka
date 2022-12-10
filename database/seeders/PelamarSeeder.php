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
      ['id_user' => 4]
    ]);
    $pelamar->each(fn ($plmr) => Pelamar::create($plmr));
  }
}
