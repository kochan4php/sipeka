<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        DB::unprepared(
            "CREATE OR REPLACE VIEW get_all_siswa_alumni AS (
                SELECT
                    sa.*,
                    u.*,
                    agkt.angkatan_tahun
                FROM siswa_alumni AS sa
                INNER JOIN angkatan AS agkt ON sa.id_angkatan = agkt.id_angkatan
                INNER JOIN pelamar AS p ON sa.id_pelamar = p.id_pelamar
                INNER JOIN users AS u ON p.id_user = u.id_user
                ORDER BY agkt.angkatan_tahun DESC
            )"
        );
    }
};
