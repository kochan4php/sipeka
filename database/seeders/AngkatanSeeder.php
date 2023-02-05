<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AngkatanSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $angkatan = [
      [
        'id_angkatan' => 'AGKT0001',
        'angkatan_tahun' => '2008/2009'
      ],
      [
        'id_angkatan' => 'AGKT0002',
        'angkatan_tahun' => '2009/2010'
      ],
      [
        'id_angkatan' => 'AGKT0003',
        'angkatan_tahun' => '2010/2011'
      ],
      [
        'id_angkatan' => 'AGKT0004',
        'angkatan_tahun' => '2011/2012'
      ],
      [
        'id_angkatan' => 'AGKT0005',
        'angkatan_tahun' => '2012/2013'
      ],
      [
        'id_angkatan' => 'AGKT0006',
        'angkatan_tahun' => '2013/2014'
      ],
      [
        'id_angkatan' => 'AGKT0007',
        'angkatan_tahun' => '2014/2015'
      ],
      [
        'id_angkatan' => 'AGKT0008',
        'angkatan_tahun' => '2015/2016'
      ],
      [
        'id_angkatan' => 'AGKT0009',
        'angkatan_tahun' => '2016/2017'
      ],
      [
        'id_angkatan' => 'AGKT0010',
        'angkatan_tahun' => '2017/2018'
      ],
      [
        'id_angkatan' => 'AGKT0011',
        'angkatan_tahun' => '2018/2019'
      ],
      [
        'id_angkatan' => 'AGKT0012',
        'angkatan_tahun' => '2019/2020'
      ],
      [
        'id_angkatan' => 'AGKT0013',
        'angkatan_tahun' => '2020/2021'
      ],
      [
        'id_angkatan' => 'AGKT0014',
        'angkatan_tahun' => '2021/2022'
      ],
      [
        'id_angkatan' => 'AGKT0015',
        'angkatan_tahun' => '2022/2023'
      ],
    ];

    Angkatan::insert($angkatan);
  }
}
