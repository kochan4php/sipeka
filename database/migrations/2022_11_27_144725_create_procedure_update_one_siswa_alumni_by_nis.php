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
        DECLARE old_nis varchar(18);
        DECLARE id_user int;
        DECLARE old_username varchar(255);

        SELECT users.id_user INTO id_user FROM users WHERE users.username = current_nis;
        SELECT users.username INTO old_username FROM users WHERE users.id_user = id_user;
        SELECT siswa_alumni.nis INTO old_nis FROM siswa_alumni WHERE siswa_alumni.nis = current_nis;

        IF ((old_nis != nis) AND (old_username = old_nis)) THEN
          UPDATE users SET users.username = nis, users.email = nis, users.password = hashing_nis WHERE users.id_user = id_user;
          UPDATE siswa_alumni SET siswa_alumni.nis = nis WHERE siswa_alumni.nis = current_nis;
        END IF;

        UPDATE siswa_alumni SET
          siswa_alumni.id_jurusan = jurusan,
          siswa_alumni.id_angkatan = tahun_angkatan,
          siswa_alumni.nama_lengkap = nama_lengkap,
          siswa_alumni.jenis_kelamin = jenis_kelamin,
          siswa_alumni.tempat_lahir = tempat_lahir,
          siswa_alumni.tanggal_lahir = tanggal_lahir,
          siswa_alumni.no_telepon = no_telepon,
          siswa_alumni.alamat_tempat_tinggal = alamat_tempat_tinggal,
          siswa_alumni.foto = foto
        WHERE siswa_alumni.nis = current_nis;
      END ;"
    );
  }
};
