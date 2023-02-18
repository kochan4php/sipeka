<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LevelUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LevelUserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        $admin = 'Admin';
        $mitraPerusahaan = 'Perusahaan';
        $pelamar = 'Pelamar';

        $levelUser = [
            [
                'id_level' => 'LU01',
                'nama_level' => $admin,
                'identifier' => strtolower(Str::slug($admin))
            ],
            [
                'id_level' => 'LU02',
                'nama_level' => $mitraPerusahaan,
                'identifier' => strtolower(Str::slug($mitraPerusahaan))
            ],
            [
                'id_level' => 'LU03',
                'nama_level' => $pelamar,
                'identifier' => strtolower(Str::slug($pelamar))
            ],
        ];

        LevelUser::insert($levelUser);
    }
}
