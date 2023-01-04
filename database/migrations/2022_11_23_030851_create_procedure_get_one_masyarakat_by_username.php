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
    DB::unprepared("DROP PROCEDURE IF EXISTS get_one_masyarakat_by_username");
    DB::unprepared(
      "CREATE PROCEDURE get_one_masyarakat_by_username(username varchar(255))
        BEGIN
        SELECT
          m.id_masyarakat,
          p.id_pelamar,
          u.id_user,
          lu.id_level,
          m.nama_lengkap,
          m.jenis_kelamin,
          m.tempat_lahir,
          m.tanggal_lahir,
          m.alamat_tempat_tinggal,
          m.no_telepon,
          m.foto,
          u.username,
          u.email,
          u.password,
          lu.nama_level
        FROM masyarakat AS m
        INNER JOIN pelamar AS p ON m.id_pelamar = p.id_pelamar
        INNER JOIN users AS u ON p.id_user = u.id_user
        INNER JOIN level_user AS lu ON u.id_level = lu.id_level
        WHERE u.username = username;
      END;"
    );
  }
};
