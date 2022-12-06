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
    DB::unprepared("DROP PROCEDURE IF EXISTS insert_one_person");
    DB::unprepared(
      "CREATE PROCEDURE insert_one_person(username varchar(255), email varchar(255), password varchar(255), nama_lengkap varchar(255), jenis_kelamin enum('L', 'P'), no_telepon varchar(20), tempat_lahir varchar(100), tanggal_lahir date, alamat_tempat_tinggal text, foto varchar(255))

      BEGIN
        DECLARE id_level_user char(4);
        DECLARE id_user int(11);
        DECLARE id_pelamar int(11);

        SELECT level_user.id_level INTO id_level_user FROM level_user WHERE identifier = lower('pelamar');

        IF ISNULL(tanggal_lahir) THEN
          SET tanggal_lahir = NULL;
        ELSE
          SET tanggal_lahir = DATE(tanggal_lahir);
        END IF;

        IF (email IS NOT NULL) THEN
          INSERT INTO users (id_level, username, email, password) VALUES (id_level_user, username, email, password);
        ELSE
          INSERT INTO users (id_level, username, email, password) VALUES (id_level_user, username, NULL, password);
        END IF;
        SELECT LAST_INSERT_ID() INTO id_user;

        INSERT INTO pelamar (id_user) VALUES (id_user);
        SELECT LAST_INSERT_ID() INTO id_pelamar;

        INSERT INTO masyarakat (id_pelamar, nama_lengkap, jenis_kelamin, no_telepon, tempat_lahir, tanggal_lahir, alamat_tempat_tinggal, foto) VALUES (
          id_pelamar,
          nama_lengkap,
          jenis_kelamin,
          no_telepon,
          tempat_lahir,
          tanggal_lahir,
          alamat_tempat_tinggal,
          foto
        );
      END ;"
    );
  }
};
