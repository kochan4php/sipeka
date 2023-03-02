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
            "CREATE OR REPLACE VIEW get_all_kantor_data AS (
                SELECT
                    mp.nama_perusahaan,
                    mp.jenis_perusahaan,
                    k.*
                FROM kantor AS k
                    INNER JOIN mitra_perusahaan AS mp ON k.id_perusahaan = mp.id_perusahaan
                WHERE mp.is_blocked = 0
                ORDER BY k.created_at DESC
            )"
        );
    }
};
