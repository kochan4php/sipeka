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
            "CREATE OR REPLACE PROCEDURE get_all_pengalaman_kerja_by_pelamar (id_pelamar int)
            BEGIN
                SELECT * FROM pengalaman_kerja AS pk
                WHERE pk.id_pelamar = id_pelamar;
            END ;"
        );
    }
};
