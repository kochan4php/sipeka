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
    DB::unprepared("DROP PROCEDURE IF EXISTS get_one_alumni_by_username");
    DB::unprepared(
      "CREATE PROCEDURE get_one_alumni_by_username(username varchar(255))
      BEGIN
        SELECT
          sa.id_siswa,
          p.id_pelamar,
          agkt.id_angkatan,
          jrs.id_jurusan,
          u.id_user,
          lu.id_level,
          sa.nis,
          sa.nama_lengkap,
          sa.jenis_kelamin,
          sa.tempat_lahir,
          sa.tanggal_lahir,
          sa.no_telepon,
          sa.alamat_tempat_tinggal,
          sa.foto,
          agkt.angkatan_tahun,
          jrs.nama_jurusan,
          jrs.keterangan,
          u.username,
          lu.nama_level
        FROM siswa_alumni AS sa
        INNER JOIN pelamar AS p ON sa.id_pelamar = p.id_pelamar
        INNER JOIN angkatan AS agkt ON sa.id_angkatan = agkt.id_angkatan
        INNER JOIN jurusan AS jrs ON sa.id_jurusan = jrs.id_jurusan
        INNER JOIN users AS u ON p.id_user = u.id_user
        INNER JOIN level_user AS lu ON u.id_level = lu.id_level
        WHERE u.username = username;
      END;"
    );
  }
};
