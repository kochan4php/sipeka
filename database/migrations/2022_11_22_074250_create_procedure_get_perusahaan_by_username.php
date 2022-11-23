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
    DB::unprepared("DROP PROCEDURE IF EXISTS get_perusahaan_by_username");
    DB::unprepared(
      "CREATE PROCEDURE get_perusahaan_by_username(username varchar(255))
      BEGIN
        SELECT
          mp.id_perusahaan,
          u.id_user,
          lu.id_level,
          mp.*,
          u.username,
          u.email,
          lu.nama_level
        FROM mitra_perusahaan AS mp
        INNER JOIN users AS u ON mp.id_user = u.id_user
        INNER JOIN level_user AS lu ON u.id_level = lu.id_level
        WHERE u.username = username;
      END;"
    );
  }
};
