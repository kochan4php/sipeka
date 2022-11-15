<?php

namespace Database\Seeders;

use App\Models\Dokumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokumenSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $dokumen = collect([
      [
        'id_jenis_dokumen' => 'DKMN001',
        'nama_dokumen' => 'KTP'
      ],
      [
        'id_jenis_dokumen' => 'DKMN002',
        'nama_dokumen' => 'Kartu Pencari Kerja'
      ],
      [
        'id_jenis_dokumen' => 'DKMN003',
        'nama_dokumen' => 'Ijazah'
      ],
      [
        'id_jenis_dokumen' => 'DKMN004',
        'nama_dokumen' => 'Legalisir Nilai'
      ],
    ]);

    $dokumen->each(fn ($dkmn) => Dokumen::create($dkmn));
  }
}
