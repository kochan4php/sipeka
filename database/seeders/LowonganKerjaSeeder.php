<?php

namespace Database\Seeders;

use App\Models\LowonganKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LowonganKerjaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $lowonganKerja = collect([
      [
        'id_perusahaan' => 1,
        'judul_lowongan' => 'Lowongan Digital Marketing',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023))
      ],
      [
        'id_perusahaan' => 2,
        'judul_lowongan' => 'Lowongan Fullstack Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023))
      ],
      [
        'id_perusahaan' => 1,
        'judul_lowongan' => 'Lowongan Laravel Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023))
      ],
      [
        'id_perusahaan' => 1,
        'judul_lowongan' => 'Lowongan Flutter Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023))
      ],
      [
        'id_perusahaan' => 1,
        'judul_lowongan' => 'Lowongan React Native Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023))
      ],
      [
        'id_perusahaan' => 2,
        'judul_lowongan' => 'Lowongan Frontend Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023))
      ],
      [
        'id_perusahaan' => 2,
        'judul_lowongan' => 'Lowongan Golang Backend Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023))
      ],
    ]);
    $lowonganKerja->each(fn ($lk) => LowonganKerja::create($lk));
  }
}
