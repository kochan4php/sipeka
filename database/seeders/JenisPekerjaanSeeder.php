<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\JenisPekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPekerjaanSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        JenisPekerjaan::insert([
            ['nama_jenis_pekerjaan' => 'Full-time'],
            ['nama_jenis_pekerjaan' => 'Part-time'],
            ['nama_jenis_pekerjaan' => 'Self-employed'],
            ['nama_jenis_pekerjaan' => 'Freelance'],
            ['nama_jenis_pekerjaan' => 'Contract'],
            ['nama_jenis_pekerjaan' => 'Internship'],
            ['nama_jenis_pekerjaan' => 'Apprenticeship'],
            ['nama_jenis_pekerjaan' => 'Seasonal'],
        ]);
    }
}
