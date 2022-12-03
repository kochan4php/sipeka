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
    DB::unprepared("DROP FUNCTION IF EXISTS generate_new_kode_angkatan");
    DB::unprepared(
      "CREATE FUNCTION generate_new_kode_angkatan() RETURNS char(8)
      BEGIN
        DECLARE kode_lama char(8);
        DECLARE kode_default char(4);
        DECLARE angka_baru char(4);
        DECLARE kode_baru char(8);

        SELECT MAX(id_angkatan) AS kode_angkatan INTO kode_lama FROM angkatan;
        SET kode_default = SUBSTRING(kode_lama, 1, 4);
        SET angka_baru = CONVERT(SUBSTRING(kode_lama, 5), UNSIGNED) + 1;
        SET angka_baru = CONVERT(LPAD(angka_baru, 4, 0), char);
        SET kode_baru = CONCAT(kode_default, angka_baru);

        RETURN kode_baru;
      END ;"
    );
  }
};
