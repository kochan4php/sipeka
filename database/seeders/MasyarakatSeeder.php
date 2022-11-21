<?php

namespace Database\Seeders;

use App\Models\Masyarakat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasyarakatSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $masyarakat = collect([
      [
        'id_pelamar' => 4,
        'nama_lengkap' => 'Fahmi Kurnia Dwi Putra',
        'jenis_kelamin' => 'L',
        'alamat_tempat_tinggal' => 'Jakasampurna',
        'tempat_lahir' => 'Bekasi',
        'tanggal_lahir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023)),
        'no_telepon' => '08988765627'
      ],
      [
        'id_pelamar' => 5,
        'nama_lengkap' => 'Andi Nawfal Dzikra',
        'jenis_kelamin' => 'L',
        'alamat_tempat_tinggal' => 'Jakasetia',
        'tempat_lahir' => 'Bekasi',
        'tanggal_lahir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023)),
        'no_telepon' => '08988765634'
      ],
      [
        'id_pelamar' => 6,
        'nama_lengkap' => 'Sandhika Galih',
        'jenis_kelamin' => 'L',
        'alamat_tempat_tinggal' => 'UNPAS',
        'tempat_lahir' => 'Bandung',
        'tanggal_lahir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023)),
        'no_telepon' => '08988765647'
      ],
    ]);
    $masyarakat->each(fn ($msyr) => Masyarakat::create($msyr));
  }
}
