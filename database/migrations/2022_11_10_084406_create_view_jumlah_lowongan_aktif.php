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
            "CREATE OR REPLACE VIEW jumlah_lowongan_aktif AS (
                SELECT count(lowongan_kerja.id_lowongan) AS jumlah_lowongan_aktif FROM lowongan_kerja
                WHERE lowongan_kerja.active = 1 AND WHERE lowongan_kerja.is_approve = 1
            )"
        );
    }
};
