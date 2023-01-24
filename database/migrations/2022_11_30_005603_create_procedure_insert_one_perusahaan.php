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
    DB::unprepared("DROP PROCEDURE IF EXISTS insert_one_perusahaan");
    DB::unprepared(
      "CREATE PROCEDURE insert_one_perusahaan(username_perusahaan varchar(255), email_perusahaan varchar(255), password_perusahaan varchar(255), nama_perusahaan varchar(255), nomor_telp_perusahaan varchar(255), foto_sampul_perusahaan varchar(255), logo_perusahaan varchar(255), deskripsi_perusahaan text, jenis_perusahaan enum('PT', 'CV'), kategori_perusahaan varchar(255))
      BEGIN
        DECLARE id_level_user char(4);
        DECLARE id_user int(11);

        SELECT level_user.id_level INTO id_level_user FROM level_user WHERE identifier = lower('perusahaan');

        INSERT INTO users (id_level, username, email, password) VALUES (id_level_user, username_perusahaan, email_perusahaan, password_perusahaan);
        SELECT LAST_INSERT_ID() INTO id_user;

        INSERT INTO mitra_perusahaan (id_user, nama_perusahaan, nomor_telp_perusahaan, foto_sampul_perusahaan, logo_perusahaan, deskripsi_perusahaan, jenis_perusahaan, kategori_perusahaan) VALUES (
          id_user,
          nama_perusahaan,
          nomor_telp_perusahaan,
          foto_sampul_perusahaan,
          logo_perusahaan,
          deskripsi_perusahaan,
          jenis_perusahaan,
          kategori_perusahaan
        );
      END ;"
    );
  }
};
