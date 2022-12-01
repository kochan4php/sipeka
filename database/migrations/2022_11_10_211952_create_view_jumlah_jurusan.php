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
      "CREATE OR REPLACE VIEW jumlah_jurusan AS (
        SELECT count(jurusan.id_jurusan) AS jumlah_jurusan FROM jurusan
      )"
    );
  }
};
