<?php

namespace Database\Seeders;

use App\Models\MitraPerusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitraPerusahaanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $perusahaan = collect([
      [
        'id_user' => 2,
        'nama_perusahaan' => 'PT Qia Solutions',
        'nomor_telp_perusahaan' => '(021)997897',
        'alamat_perusahaan' => 'Jl. Mustika No.18, RT.4/RW.11, Bidara Cina, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta'
      ],
      [
        'id_user' => 3,
        'nama_perusahaan' => 'PT Catur Jaya Solusi Bersama',
        'nomor_telp_perusahaan' => '(021)997896',
        'alamat_perusahaan' => 'Komp. Mas Naga, Jl. Gn. Kerinci II, Block A, No. 897, Bintara Jaya Bekasi Barat, Jawa Barat 17136'
      ],
    ]);
    $perusahaan->each(fn ($mp) => MitraPerusahaan::create($mp));
  }
}
