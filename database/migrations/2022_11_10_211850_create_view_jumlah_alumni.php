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
            "CREATE OR REPLACE VIEW jumlah_alumni AS (
                SELECT count(siswa_alumni.id_siswa) AS jumlah_alumni FROM siswa_alumni
            )"
        );
    }
};
