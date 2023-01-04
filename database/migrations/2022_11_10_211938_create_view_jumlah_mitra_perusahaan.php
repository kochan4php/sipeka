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
    DB::unprepared(
      "CREATE OR REPLACE VIEW jumlah_mitra_perusahaan AS (
        SELECT count(mitra_perusahaan.id_perusahaan) AS jumlah_mitra_perusahaan FROM mitra_perusahaan
      )"
    );
  }
};
