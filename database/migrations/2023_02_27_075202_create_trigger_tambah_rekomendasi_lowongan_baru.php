<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        DB::unprepared(
            "CREATE OR REPLACE TRIGGER tambah_rekomendasi_lowongan_baru AFTER INSERT ON rekomendasi_lowongan FOR EACH ROW
            BEGIN
                DECLARE nama_alumni VARCHAR(255);
                DECLARE judul_lowongan VARCHAR(255);
                DECLARE msg text;

                SELECT siswa_alumni.nama_lengkap INTO nama_alumni FROM siswa_alumni
                WHERE siswa_alumni.id_siswa = new.id_siswa;

                SELECT lowongan_kerja.judul_lowongan INTO judul_lowongan FROM lowongan_kerja
                WHERE lowongan_kerja.id_lowongan = new.id_lowongan;

                SET msg = CONCAT(
                    'Berhasil menambahkan rekomendasi lowongan ',
                    judul_lowongan,
                    ' untuk alumni ',
                    nama_alumni
                );

                INSERT INTO rekomendasi_lowongan_log (
                    nama_alumni,
                    judul_lowongan,
                    event,
                    keterangan
                ) VALUES (
                    nama_alumni,
                    judul_lowongan,
                    'insert',
                    msg
                );
            END ;"
        );
    }
};
