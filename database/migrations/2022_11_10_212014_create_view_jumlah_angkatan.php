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
      "CREATE OR REPLACE VIEW jumlah_angkatan AS (
        SELECT count(angkatan.id_angkatan) AS jumlah_angkatan FROM angkatan
      )"
    );
  }
};
