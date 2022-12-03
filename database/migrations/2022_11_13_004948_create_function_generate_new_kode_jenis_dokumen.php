<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::unprepared("DROP FUNCTION IF EXISTS generate_new_kode_jenis_dokumen");
    DB::unprepared(
      "CREATE FUNCTION generate_new_kode_jenis_dokumen() RETURNS char(7)
      BEGIN
        DECLARE kode_lama char(7);
        DECLARE kode_default char(4);
        DECLARE angka_baru char(3);
        DECLARE kode_baru char(7);

        SELECT MAX(id_jenis_dokumen) AS kode_dokumen INTO kode_lama FROM dokumen;
        SET kode_default = SUBSTRING(kode_lama, 1, 4);
        SET angka_baru = CONVERT(SUBSTRING(kode_lama, 5), UNSIGNED) + 1;
        SET angka_baru = CONVERT(LPAD(angka_baru, 3, 0), char);
        SET kode_baru = CONCAT(kode_default, angka_baru);

        RETURN kode_baru;
      END ;"
    );
  }
};
