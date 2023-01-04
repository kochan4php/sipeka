<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    DB::unprepared("DROP FUNCTION IF EXISTS generate_new_kode_jenis_dokumen");
    DB::unprepared(
      "CREATE FUNCTION generate_new_kode_jenis_dokumen() RETURNS char(7)
      BEGIN
        DECLARE kode_lama char(7) DEFAULT NULL;
        DECLARE kode_default char(4) DEFAULT NULL;
        DECLARE angka_baru char(3) DEFAULT NULL;
        DECLARE kode_baru char(7) DEFAULT NULL;

        SELECT MAX(id_jenis_dokumen) AS kode_dokumen INTO kode_lama FROM dokumen;
        IF (kode_lama IS NOT NULL) THEN
          SET kode_default = SUBSTRING(kode_lama, 1, 4);
          SET angka_baru = CONVERT(SUBSTRING(kode_lama, 5), UNSIGNED) + 1;
          SET angka_baru = CONVERT(LPAD(angka_baru, 3, 0), char);
          SET kode_baru = CONCAT(kode_default, angka_baru);
        ELSE
          SET kode_baru = 'DKMN001';
        END IF;

        RETURN kode_baru;
      END ;"
    );
  }
};
