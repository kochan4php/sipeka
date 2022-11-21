<?php

namespace Database\Seeders;

use App\Models\SiswaAlumni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaAlumniSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $alumni = collect([
      [
        'id_pelamar' => 1,
        'id_angkatan' => 'AGKT0001',
        'id_jurusan' => 'JRS0001',
        'nis' => 2021209875,
        'nama_lengkap' => 'Aphrodeo Subarno',
        'jenis_kelamin' => 'L',
        'tempat_lahir' => 'Bekasi',
        'tanggal_lahir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023)),
        'no_telepon' => '08988928263',
        'alamat_tempat_tinggal' => 'Tokyo, Jepang',
      ],
      [
        'id_pelamar' => 2,
        'id_angkatan' => 'AGKT0002',
        'id_jurusan' => 'JRS0003',
        'nis' => 2021209874,
        'nama_lengkap' => 'Layla Mayrisa',
        'jenis_kelamin' => 'P',
        'tempat_lahir' => 'Bekasi',
        'tanggal_lahir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023)),
        'no_telepon' => '08988928260',
        'alamat_tempat_tinggal' => 'Osaka, Jepang',
      ],
      [
        'id_pelamar' => 3,
        'id_angkatan' => 'AGKT0002',
        'id_jurusan' => 'JRS0004',
        'nis' => 2021209873,
        'nama_lengkap' => 'Fitri Nurfadhila',
        'jenis_kelamin' => 'P',
        'tempat_lahir' => 'Bekasi',
        'tanggal_lahir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023)),
        'no_telepon' => '08988928262',
        'alamat_tempat_tinggal' => 'Kyoto, Jepang',
      ],
      [
        'id_pelamar' => 7,
        'id_angkatan' => 'AGKT0001',
        'id_jurusan' => 'JRS0002',
        'nis' => 2021209872,
        'nama_lengkap' => 'Arfy Slowy',
        'jenis_kelamin' => 'L',
        'tempat_lahir' => 'Bekasi',
        'tanggal_lahir' => date('Y-m-d H:i:s', mktime(10, 0, 0, 3, 18, 2023)),
        'no_telepon' => '08988928362',
        'alamat_tempat_tinggal' => 'New York',
      ],
    ]);
    $alumni->each(fn ($siswa) => SiswaAlumni::create($siswa));
  }
}
