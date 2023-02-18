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
            "CREATE OR REPLACE VIEW jumlah_masyarakat AS (
                SELECT count(masyarakat.id_masyarakat) AS jumlah_masyarakat FROM masyarakat
            )"
        );
    }
};
