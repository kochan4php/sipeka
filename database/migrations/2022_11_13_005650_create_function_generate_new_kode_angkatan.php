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
        DB::unprepared("DROP FUNCTION IF EXISTS generate_new_kode_angkatan");
        DB::unprepared(
            "CREATE FUNCTION generate_new_kode_angkatan() RETURNS char(8)
            DETERMINISTIC
            BEGIN
                DECLARE kode_lama char(8);
                DECLARE kode_default char(4);
                DECLARE angka_baru char(4);
                DECLARE kode_baru char(8);

                SELECT MAX(id_angkatan) AS kode_angkatan INTO kode_lama FROM angkatan;

                IF (kode_lama IS NOT NULL) THEN
                    SET kode_default = SUBSTRING(kode_lama, 1, 4);
                    SET angka_baru = CONVERT(SUBSTRING(kode_lama, 5), UNSIGNED) + 1;
                    SET angka_baru = CONVERT(LPAD(angka_baru, 4, 0), char);
                    SET kode_baru = CONCAT(kode_default, angka_baru);
                ELSE
                    SET kode_baru = 'AGKT0001';
                END IF;

                RETURN kode_baru;
            END ;"
        );
    }
};
