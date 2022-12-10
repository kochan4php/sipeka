<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $users = collect([
      [
        'id_level' => 'LU01',
        'username' => 'admin',
        'email' => 'bkksmkn1bekasi@gmail.com',
        'password' => Hash::make('admin')
      ],
      [
        'id_level' => 'LU02',
        'username' => 'PT.Suka-suka',
        'email' => 'Cina@gmail.com',
        'password' => Hash::make('perusahaan')
      ],
      [
        'id_level' => 'LU02',
        'username' => 'PT.LaylaBocil',
        'email' => 'layla@gmail.com',
        'password' => Hash::make('perusahaan')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'saiaaa',
        'email' => 'mrs@gmail.com',
        'password' => Hash::make('perusahaan')
      ]
    ]);
    $users->each(fn ($user) => User::create($user));
  }
}
