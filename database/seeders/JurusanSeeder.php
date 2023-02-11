<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(): void {
    $jurusan = [
      [
        'id_jurusan' => 'JRS0001',
        'nama_jurusan' => 'RPL',
        'keterangan' => 'Rekayasa Perangkat Lunak'
      ],
      [
        'id_jurusan' => 'JRS0002',
        'nama_jurusan' => 'TKJ',
        'keterangan' => 'Teknik Komputer Jaringan'
      ],
      [
        'id_jurusan' => 'JRS0003',
        'nama_jurusan' => 'MM',
        'keterangan' => 'Multimedia'
      ],
      [
        'id_jurusan' => 'JRS0004',
        'nama_jurusan' => 'TKR',
        'keterangan' => 'Teknik Kendaraan Ringan'
      ],
      [
        'id_jurusan' => 'JRS0005',
        'nama_jurusan' => 'AK',
        'keterangan' => 'Akuntasi'
      ],
    ];

    Jurusan::insert($jurusan);
  }
}
