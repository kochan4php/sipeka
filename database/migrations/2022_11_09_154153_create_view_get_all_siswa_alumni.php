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
    DB::unprepared(
      "CREATE OR REPLACE VIEW get_all_siswa_alumni AS (
        SELECT
          sa.*,
          agkt.angkatan_tahun
        FROM siswa_alumni AS sa
        INNER JOIN angkatan AS agkt ON sa.id_angkatan = agkt.id_angkatan
      )"
    );
  }
};
