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
    DB::unprepared("DROP PROCEDURE IF EXISTS update_one_person_by_username");
    DB::unprepared(
      "CREATE PROCEDURE update_one_person_by_username(current_username varchar(255), email varchar(255), nama_lengkap varchar(255), jenis_kelamin enum('L', 'P'), no_telepon varchar(20), tempat_lahir varchar(100), tanggal_lahir date, alamat_tempat_tinggal text, foto varchar(255))
      BEGIN
        DECLARE username varchar(255) DEFAULT NULL;
        DECLARE id_user int(11);
        DECLARE current_email varchar(255);

        SELECT users.id_user INTO id_user FROM users WHERE users.username = current_username;
        SELECT users.email INTO current_email FROM users WHERE users.id_user = id_user;

        IF ((email IS NOT NULL) OR (email != current_email)) THEN
          UPDATE users SET users.email = email WHERE users.id_user = id_user;
        END IF;

        SET username = lower(replace(replace(nama_lengkap, ' ', '-'), '.', ''));
        UPDATE masyarakat
          INNER JOIN pelamar ON masyarakat.id_pelamar = pelamar.id_pelamar
          INNER JOIN users ON pelamar.id_user = users.id_user
          SET masyarakat.nama_lengkap = nama_lengkap
          WHERE users.id_user = id_user;

        IF ((username IS NOT NULL) AND (username != current_username)) THEN
          UPDATE users SET users.username = username WHERE users.id_user = id_user;
        END IF;

        IF ISNULL(tanggal_lahir) THEN
          SET tanggal_lahir = NULL;
        ELSE
          SET tanggal_lahir = DATE(tanggal_lahir);
        END IF;

        UPDATE masyarakat
          INNER JOIN pelamar ON masyarakat.id_pelamar = pelamar.id_pelamar
          INNER JOIN users ON pelamar.id_user = users.id_user
          SET
            masyarakat.nama_lengkap = nama_lengkap,
            masyarakat.jenis_kelamin = jenis_kelamin,
            masyarakat.no_telepon = no_telepon,
            masyarakat.tempat_lahir = tempat_lahir,
            masyarakat.tanggal_lahir = tanggal_lahir,
            masyarakat.alamat_tempat_tinggal = alamat_tempat_tinggal,
            masyarakat.foto = foto
          WHERE users.id_user = id_user;
      END ;"
    );
  }
};
