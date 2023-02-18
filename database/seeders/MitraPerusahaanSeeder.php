<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\MitraPerusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitraPerusahaanSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        MitraPerusahaan::factory(100)->hasKantor(10)->create();
    }
}
