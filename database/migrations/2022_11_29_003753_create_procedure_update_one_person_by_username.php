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
      "CREATE PROCEDURE update_one_person_by_username(current_username varchar(255), nama_lengkap varchar(255), new_username varchar(255), jenis_kelamin enum('L', 'P'), no_telepon varchar(20), tempat_lahir varchar(100), tanggal_lahir date, alamat_tempat_tinggal text, foto varchar(255))
      BEGIN
        DECLARE id_user int(11);
        DECLARE old_nama varchar(255);

        SELECT users.id_user INTO id_user FROM users WHERE users.username = current_username;
        SELECT masyarakat.nama_lengkap INTO old_nama FROM masyarakat
          INNER JOIN pelamar ON masyarakat.id_pelamar = pelamar.id_pelamar
          INNER JOIN users ON pelamar.id_user = users.id_user
        WHERE users.id_user = id_user;

        IF ((old_nama != nama_lengkap)) THEN
          UPDATE users SET users.username = new_username WHERE users.id_user = id_user;
          UPDATE masyarakat
            INNER JOIN pelamar ON masyarakat.id_pelamar = pelamar.id_pelamar
            INNER JOIN users ON pelamar.id_user = users.id_user
            SET masyarakat.nama_lengkap = nama_lengkap
            WHERE users.id_user = id_user;
        END IF;

        IF ISNULL(tanggal_lahir) THEN
          SET tanggal_lahir = NULL;
        ELSE
          SET tanggal_lahir = DATE(tanggal_lahir);
        END IF;

        IF (foto IS NOT NULL) THEN
          UPDATE masyarakat
          INNER JOIN pelamar ON masyarakat.id_pelamar = pelamar.id_pelamar
          INNER JOIN users ON pelamar.id_user = users.id_user
          SET masyarakat.foto = foto
          WHERE users.id_user = id_user;
        END IF;

        UPDATE masyarakat
          INNER JOIN pelamar ON masyarakat.id_pelamar = pelamar.id_pelamar
          INNER JOIN users ON pelamar.id_user = users.id_user
          SET
            masyarakat.jenis_kelamin = jenis_kelamin,
            masyarakat.no_telepon = no_telepon,
            masyarakat.tempat_lahir = tempat_lahir,
            masyarakat.tanggal_lahir = tanggal_lahir,
            masyarakat.alamat_tempat_tinggal = alamat_tempat_tinggal
          WHERE users.id_user = id_user;
      END ;"
    );
  }
};
