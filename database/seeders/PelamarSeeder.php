<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Pelamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelamarSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        Pelamar::factory(200);
    }
}
