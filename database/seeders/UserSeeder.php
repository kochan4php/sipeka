<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(): void {
    User::create([
      'id_level' => 'LU01',
      'username' => 'admin',
      'email' => 'bkksmkn1bekasi@gmail.com',
      'password' => Hash::make('admin')
    ]);
    User::factory(300);
  }
}
