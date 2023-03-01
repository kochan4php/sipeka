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
            "CREATE OR REPLACE PROCEDURE get_all_latar_pendidikan_by_pelamar (id_pelamar int)
            BEGIN
                SELECT * FROM riwayat_pendidikan AS rp
                WHERE rp.id_pelamar = id_pelamar;
            END ;"
        );
    }
};
