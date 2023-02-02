<?php

namespace Database\Seeders;

use App\Models\{User, Pelamar};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    User::create([
      'id_level' => 'LU01',
      'username' => 'admin',
      'email' => 'bkksmkn1bekasi@gmail.com',
      'password' => Hash::make('admin')
    ]);
    // User::factory(1000)->hasPerusahaan()->create();
    User::factory(100)->has(Pelamar::factory()->hasMasyarakat())->create();
    User::factory(100)->has(Pelamar::factory()->hasAlumni())->create();
  }
}
