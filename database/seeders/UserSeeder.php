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
        'username' => 'pt-qia-solutions',
        'email' => 'qiasolution@gmail.com',
        'password' => Hash::make('perusahaan')
      ],
      [
        'id_level' => 'LU02',
        'username' => 'pt-catur-jaya-solusi-bersama',
        'email' => 'caturjayasolusibersama@gmail.com',
        'password' => Hash::make('perusahaan')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'deosubarno',
        'email' => 'aprodeosubarno@gmail.com',
        'password' => Hash::make('password')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'layla-mayrisa',
        'email' => 'laylamayrisa@gmail.com',
        'password' => Hash::make('password')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'fitri-nurfadhila',
        'email' => 'fitrinurfadhila@gmail.com',
        'password' => Hash::make('password')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'fkdp',
        'email' => 'fahmikurnia@gmail.com',
        'password' => Hash::make('password')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'andinopal',
        'email' => 'andinawfal@gmail.com',
        'password' => Hash::make('password')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'sandhika-galih',
        'email' => 'sandhikagalih@gmail.com',
        'password' => Hash::make('password')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'arfy-slowy',
        'email' => 'arfy@gmail.com',
        'password' => Hash::make('password')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'senopati',
        'email' => 'senopati@gmail.com',
        'password' => Hash::make('password')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'hafizzul',
        'email' => 'hafiz@gmail.com',
        'password' => Hash::make('password')
      ],
      [
        'id_level' => 'LU03',
        'username' => 'danny',
        'email' => 'danny@gmail.com',
        'password' => Hash::make('password')
      ],
    ]);
    $users->each(fn ($user) => User::create($user));
  }
}
