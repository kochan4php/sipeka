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
    DB::unprepared("DROP PROCEDURE IF EXISTS update_one_perusahaan_by_username");
    DB::unprepared(
      "CREATE PROCEDURE update_one_perusahaan_by_username(old_username varchar(255), new_username_perusahaan varchar(255), email_perusahaan varchar(255), nama_perusahaan varchar(255), nomor_telp_perusahaan varchar(255), alamat_perusahaan text, foto_sampul_perusahaan varchar(255), logo_perusahaan varchar(255), deskripsi_perusahaan text, jenis_perusahaan enum('PT', 'CV'))
      BEGIN
        DECLARE id_user int(11);
        DECLARE old_email varchar(255);

        SELECT users.id_user INTO id_user FROM users WHERE users.username = old_username;
        SELECT users.email INTO old_email FROM users WHERE users.id_user = id_user;

        IF (new_username_perusahaan IS NOT NULL) THEN
          UPDATE users SET users.username = new_username_perusahaan WHERE users.id_user = id_user;
        END IF;

        IF (email_perusahaan != old_email) THEN
          UPDATE users SET users.email = email_perusahaan WHERE users.id_user = id_user;
        END IF;

        IF (foto_sampul_perusahaan IS NOT NULL) THEN
          UPDATE mitra_perusahaan
          INNER JOIN users ON mitra_perusahaan.id_user = users.id_user
          SET mitra_perusahaan.foto_sampul_perusahaan = foto_sampul_perusahaan
          WHERE users.id_user = id_user;
        END IF;

        IF (logo_perusahaan IS NOT NULL) THEN
          UPDATE mitra_perusahaan
          INNER JOIN users ON mitra_perusahaan.id_user = users.id_user
          SET mitra_perusahaan.logo_perusahaan = logo_perusahaan
          WHERE users.id_user = id_user;
        END IF;

        UPDATE mitra_perusahaan
          INNER JOIN users ON mitra_perusahaan.id_user = users.id_user
          SET
            mitra_perusahaan.nama_perusahaan = nama_perusahaan,
            mitra_perusahaan.nomor_telp_perusahaan = nomor_telp_perusahaan,
            mitra_perusahaan.deskripsi_perusahaan = deskripsi_perusahaan,
            mitra_perusahaan.alamat_perusahaan = alamat_perusahaan,
            mitra_perusahaan.jenis_perusahaan = jenis_perusahaan
          WHERE users.id_user = id_user;
      END ;"
    );
  }
};
