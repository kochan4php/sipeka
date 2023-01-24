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
      "CREATE OR REPLACE VIEW jumlah_lowongan AS (
        SELECT count(lowongan_kerja.id_lowongan) AS jumlah_lowongan FROM lowongan_kerja WHERE active = 1
      )"
    );
  }
};
