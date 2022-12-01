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
    DB::unprepared("DROP PROCEDURE IF EXISTS update_one_perusahaan_by_username");
    DB::unprepared(
      "CREATE PROCEDURE update_one_perusahaan_by_username(current_username varchar(255), email varchar(255), new_password varchar(255), nama_perusahaan varchar(255), nomor_telp_perusahaan varchar(255), alamat_perusahaan text, foto_sampul_perusahaan varchar(255), logo_perusahaan varchar(255), deskripsi_perusahaan text)
      BEGIN
        DECLARE id_user int(11);
        DECLARE old_email varchar(255) DEFAULT NULL;
        DECLARE old_username varchar(255);
        DECLARE new_username varchar(255);

        SET new_username = lower(replace(replace(nama_perusahaan, ' ', '-'), '.', ''));
        SELECT users.id_user INTO id_user FROM users WHERE users.username = current_username;
        SELECT users.email INTO old_email FROM users WHERE users.id_user = id_user;
        SELECT users.username INTO old_username FROM users WHERE users.id_user = id_user;

        IF ((old_email IS NOT NULL) OR (email != old_email)) THEN
         UPDATE users SET users.email = email WHERE users.id_user = id_user;
        END IF;

        IF (new_username != old_username) THEN
          UPDATE users SET users.username = new_username WHERE users.id_user = id_user;
          UPDATE mitra_perusahaan
            INNER JOIN users ON mitra_perusahaan.id_user = users.id_user
            SET mitra_perusahaan.nama_perusahaan = nama_perusahaan
            WHERE users.id_user = id_user;
        END IF;

        IF (new_password IS NOT NULL) THEN
          UPDATE users SET users.password = new_password WHERE users.id_user = id_user;
        END IF;

        UPDATE mitra_perusahaan
        INNER JOIN users ON mitra_perusahaan.id_user = users.id_user
        SET
          mitra_perusahaan.nomor_telp_perusahaan = nomor_telp_perusahaan,
          mitra_perusahaan.foto_sampul_perusahaan = foto_sampul_perusahaan,
          mitra_perusahaan.logo_perusahaan = logo_perusahaan,
          mitra_perusahaan.deskripsi_perusahaan = deskripsi_perusahaan,
          mitra_perusahaan.alamat_perusahaan = alamat_perusahaan
        WHERE users.id_user = id_user;
      END ;"
    );
  }
};
