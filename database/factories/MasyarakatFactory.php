<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Pelamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Masyarakat>
 */
class MasyarakatFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'id_pelamar' => Pelamar::factory(),
            'nama_lengkap' => fake()->firstNameFemale(),
            'jenis_kelamin' => 'P',
        ];
    }
}
