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
        DB::unprepared("DROP FUNCTION IF EXISTS generate_new_kode_jurusan");
        DB::unprepared(
            "CREATE FUNCTION generate_new_kode_jurusan() RETURNS char(7)
            BEGIN
                DECLARE kode_lama char(7);
                DECLARE kode_default char(3);
                DECLARE angka_baru char(4);
                DECLARE kode_baru char(7);

                SELECT MAX(id_jurusan) AS kode_jurusan INTO kode_lama FROM jurusan;
                IF (kode_lama IS NOT NULL) THEN
                    SET kode_default = SUBSTRING(kode_lama, 1, 3);
                    SET angka_baru = CONVERT(SUBSTRING(kode_lama, 4), UNSIGNED) + 1;
                    SET angka_baru = CONVERT(LPAD(angka_baru, 4, 0), char);
                    SET kode_baru = CONCAT(kode_default, angka_baru);
                ELSE
                    SET kode_baru = 'JRS0001';
                END IF;

                RETURN kode_baru;
            END ;"
        );
    }
};
