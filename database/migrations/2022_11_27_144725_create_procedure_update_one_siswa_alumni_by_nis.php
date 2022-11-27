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
    DB::unprepared("DROP PROCEDURE IF EXISTS update_one_siswa_alumni_by_nis");
    DB::unprepared(
      "CREATE PROCEDURE update_one_siswa_alumni_by_nis(current_nis varchar(18), id_user int(11), hashing_nis varchar(255), jurusan char(7), tahun_angkatan char(8), nis varchar(18), nama_lengkap varchar(255), jenis_kelamin enum('L', 'P'), tempat_lahir varchar(100), tanggal_lahir date, no_telepon varchar(20), alamat_tempat_tinggal text, foto varchar(255))
      BEGIN
        DECLARE username varchar(255);
        SET username = lower(replace(replace(nama_lengkap, ' ', '-'), '.', ''));

        IF ISNULL(hashing_nis) THEN
          UPDATE users SET
            users.username = username,
            users.email = nis
          WHERE users.id_user = id_user;
        ELSE
          UPDATE users SET
            users.username = username,
            users.email = nis,
            users.password = hashing_nis
          WHERE users.id_user = id_user;
        END IF;

        IF (ISNULL(tempat_lahir) AND ISNULL(tanggal_lahir) AND ISNULL(no_telepon) AND ISNULL(alamat_tempat_tinggal) AND ISNULL(foto)) THEN
          UPDATE siswa_alumni SET
            siswa_alumni.id_jurusan = jurusan,
            siswa_alumni.id_angkatan = tahun_angkatan,
            siswa_alumni.nis = nis,
            siswa_alumni.nama_lengkap = nama_lengkap,
            siswa_alumni.jenis_kelamin = jenis_kelamin
          WHERE siswa_alumni.nis = current_nis;
        ELSEIF (ISNULL(tanggal_lahir) AND ISNULL(no_telepon) AND ISNULL(alamat_tempat_tinggal) AND ISNULL(foto)) THEN
          UPDATE siswa_alumni SET
            siswa_alumni.id_jurusan = jurusan,
            siswa_alumni.id_angkatan = tahun_angkatan,
            siswa_alumni.nis = nis,
            siswa_alumni.nama_lengkap = nama_lengkap,
            siswa_alumni.jenis_kelamin = jenis_kelamin,
            siswa_alumni.tempat_lahir = tempat_lahir
          WHERE siswa_alumni.nis = current_nis;
        ELSEIF (ISNULL(no_telepon) AND ISNULL(alamat_tempat_tinggal) AND ISNULL(foto)) THEN
          UPDATE siswa_alumni SET
            siswa_alumni.id_jurusan = jurusan,
            siswa_alumni.id_angkatan = tahun_angkatan,
            siswa_alumni.nis = nis,
            siswa_alumni.nama_lengkap = nama_lengkap,
            siswa_alumni.jenis_kelamin = jenis_kelamin,
            siswa_alumni.tempat_lahir = tempat_lahir,
            siswa_alumni.tanggal_lahir = tanggal_lahir
          WHERE siswa_alumni.nis = current_nis;
        ELSEIF (ISNULL(alamat_tempat_tinggal) AND ISNULL(foto)) THEN
          UPDATE siswa_alumni SET
            siswa_alumni.id_jurusan = jurusan,
            siswa_alumni.id_angkatan = tahun_angkatan,
            siswa_alumni.nis = nis,
            siswa_alumni.nama_lengkap = nama_lengkap,
            siswa_alumni.jenis_kelamin = jenis_kelamin,
            siswa_alumni.tempat_lahir = tempat_lahir,
            siswa_alumni.tanggal_lahir = tanggal_lahir,
            siswa_alumni.no_telepon = no_telepon
          WHERE siswa_alumni.nis = current_nis;
        ELSEIF (ISNULL(foto)) THEN
          UPDATE siswa_alumni SET
            siswa_alumni.id_jurusan = jurusan,
            siswa_alumni.id_angkatan = tahun_angkatan,
            siswa_alumni.nis = nis,
            siswa_alumni.nama_lengkap = nama_lengkap,
            siswa_alumni.jenis_kelamin = jenis_kelamin,
            siswa_alumni.tempat_lahir = tempat_lahir,
            siswa_alumni.tanggal_lahir = tanggal_lahir,
            siswa_alumni.no_telepon = no_telepon,
            siswa_alumni.alamat_tempat_tinggal = alamat_tempat_tinggal
          WHERE siswa_alumni.nis = current_nis;
        ELSE
          UPDATE siswa_alumni SET
            siswa_alumni.id_jurusan = jurusan,
            siswa_alumni.id_angkatan = tahun_angkatan,
            siswa_alumni.nis = nis,
            siswa_alumni.nama_lengkap = nama_lengkap,
            siswa_alumni.jenis_kelamin = jenis_kelamin,
            siswa_alumni.tempat_lahir = tempat_lahir,
            siswa_alumni.tanggal_lahir = tanggal_lahir,
            siswa_alumni.no_telepon = no_telepon,
            siswa_alumni.alamat_tempat_tinggal = alamat_tempat_tinggal,
            siswa_alumni.foto = foto
          WHERE siswa_alumni.nis = current_nis;
        END IF;
      END ;"
    );
  }
};
