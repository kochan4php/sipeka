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
            "CREATE OR REPLACE VIEW get_all_perusahaan AS (
                SELECT
                    mp.id_perusahaan,
                    u.id_user,
                    lu.id_level,
                    mp.nama_perusahaan,
                    mp.nomor_telp_perusahaan,
                    u.username,
                    u.email,
                    lu.nama_level
                FROM mitra_perusahaan AS mp
                INNER JOIN users AS u ON mp.id_user = u.id_user
                INNER JOIN level_user AS lu ON u.id_level = lu.id_level
            )"
        );
    }
};
