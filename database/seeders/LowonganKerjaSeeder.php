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
        'id_perusahaan' => 2,
        'judul_lowongan' => 'Lowongan Digital Marketing',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('d-m-Y', mktime(day: 26, month: 1, year: 2023, hour: 0))
      ],
      [
        'id_perusahaan' => 3,
        'judul_lowongan' => 'Lowongan Fullstack Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('d-m-Y', mktime(day: 30, month: 2, year: 2023, hour: 0))
      ],
      [
        'id_perusahaan' => 2,
        'judul_lowongan' => 'Lowongan Laravel Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('d-m-Y', mktime(day: 10, month: 2, year: 2023, hour: 0))
      ],
      [
        'id_perusahaan' => 2,
        'judul_lowongan' => 'Lowongan Flutter Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('d-m-Y', mktime(day: 30, month: 1, year: 2023, hour: 0))
      ],
      [
        'id_perusahaan' => 2,
        'judul_lowongan' => 'Lowongan React Native Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('d-m-Y', mktime(day: 30, month: 3, year: 2023, hour: 0))
      ],
      [
        'id_perusahaan' => 3,
        'judul_lowongan' => 'Lowongan Frontend Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('d-m-Y', mktime(day: 15, month: 3, year: 2023, hour: 0))
      ],
      [
        'id_perusahaan' => 3,
        'judul_lowongan' => 'Lowongan Golang Backend Developer',
        'deskripsi_lowongan' => 'Lorem ipsum dolor sit amet consectuer',
        'tanggal_dimulai' => now(),
        'tanggal_berakhir' => date('d-m-Y', mktime(day: 15, month: 2, year: 2023, hour: 0))
      ],
    ]);
    $lowonganKerja->each(fn ($lk) => LowonganKerja::creaet($lk));
  }
}
