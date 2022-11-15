<?php

namespace Database\Seeders;

use App\Models\AdminBKK;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminBKKSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    AdminBKK::create([
      'id_admin' => 'ADM01',
      'id_user' => 1,
      'nama_admin' => 'Admin BKK 1'
    ]);
  }
}
