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
            "CREATE OR REPLACE VIEW get_all_masyarakat AS (
                SELECT
                    m.*,
                    u.*
                FROM masyarakat AS m
                    INNER JOIN pelamar AS p ON m.id_pelamar = p.id_pelamar
                    INNER JOIN users AS u ON p.id_user = u.id_user
                ORDER BY m.id_masyarakat DESC
            )"
        );
    }
};
