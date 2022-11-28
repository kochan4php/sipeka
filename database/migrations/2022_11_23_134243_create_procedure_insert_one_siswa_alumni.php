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
    DB::unprepared('DROP PROCEDURE IF EXISTS insert_one_siswa_alumni');
    DB::unprepared(
      "CREATE PROCEDURE insert_one_siswa_alumni(hashing_nis varchar(255), jurusan char(7), tahun_angkatan char(8), nis varchar(18), nama_lengkap varchar(255), jenis_kelamin enum('L', 'P'), tempat_lahir varchar(100), tanggal_lahir date, no_telepon varchar(20), alamat_tempat_tinggal text, foto varchar(255))

      BEGIN
        DECLARE id_level_user char(4);
        DECLARE username varchar(255);
        DECLARE id_user int(11);
        DECLARE id_pelamar int(11);

        SET username = lower(replace(replace(nama_lengkap, ' ', '-'), '.', ''));
        SELECT level_user.id_level INTO id_level_user FROM level_user WHERE nama_level = 'Pelamar';

        INSERT INTO users (id_level, username, email, password) VALUES (id_level_user, username, nis, hashing_nis);
        SELECT LAST_INSERT_ID() INTO id_user;

        INSERT INTO pelamar (id_user) VALUES (id_user);
        SELECT LAST_INSERT_ID() INTO id_pelamar;

        IF (ISNULL(tempat_lahir) AND ISNULL(tanggal_lahir) AND ISNULL(no_telepon) AND ISNULL(alamat_tempat_tinggal) AND ISNULL(foto)) THEN
          INSERT INTO siswa_alumni (id_pelamar, id_angkatan, id_jurusan, nis, nama_lengkap, jenis_kelamin) VALUES (
            id_pelamar,
            tahun_angkatan,
            jurusan,
            nis,
            nama_lengkap,
            jenis_kelamin
          );
        ELSEIF (ISNULL(tanggal_lahir) AND ISNULL(no_telepon) AND ISNULL(alamat_tempat_tinggal) AND ISNULL(foto)) THEN
          INSERT INTO siswa_alumni (id_pelamar, id_angkatan, id_jurusan, nis, nama_lengkap, jenis_kelamin, tempat_lahir) VALUES (
            id_pelamar,
            tahun_angkatan,
            jurusan,
            nis,
            nama_lengkap,
            jenis_kelamin,
            tempat_lahir
          );
        ELSEIF (ISNULL(no_telepon) AND ISNULL(alamat_tempat_tinggal) AND ISNULL(foto)) THEN
          INSERT INTO siswa_alumni (id_pelamar, id_angkatan, id_jurusan, nis, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir) VALUES (
            id_pelamar,
            tahun_angkatan,
            jurusan,
            nis,
            nama_lengkap,
            jenis_kelamin,
            tempat_lahir,
            tanggal_lahir
          );
        ELSEIF (ISNULL(alamat_tempat_tinggal) AND ISNULL(foto)) THEN
          INSERT INTO siswa_alumni (id_pelamar, id_angkatan, id_jurusan, nis, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, no_telepon) VALUES (
            id_pelamar,
            tahun_angkatan,
            jurusan,
            nis,
            nama_lengkap,
            jenis_kelamin,
            tempat_lahir,
            tanggal_lahir,
            no_telepon
          );
        ELSEIF (ISNULL(foto)) THEN
          INSERT INTO siswa_alumni (id_pelamar, id_angkatan, id_jurusan, nis, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, no_telepon, alamat_tempat_tinggal) VALUES (
            id_pelamar,
            tahun_angkatan,
            jurusan,
            nis,
            nama_lengkap,
            jenis_kelamin,
            tempat_lahir,
            tanggal_lahir,
            no_telepon,
            alamat_tempat_tinggal
          );
        ELSE
          INSERT INTO siswa_alumni (id_pelamar, id_angkatan, id_jurusan, nis, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, no_telepon, alamat_tempat_tinggal, foto) VALUES (
            id_pelamar,
            tahun_angkatan,
            jurusan,
            nis,
            nama_lengkap,
            jenis_kelamin,
            tempat_lahir,
            tanggal_lahir,
            no_telepon,
            alamat_tempat_tinggal,
            foto
          );
        END IF;
      END ;"
    );
  }
};
