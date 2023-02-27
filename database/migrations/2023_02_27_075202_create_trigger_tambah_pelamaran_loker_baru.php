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
            "CREATE OR REPLACE TRIGGER tambah_pelamaran_loker_baru AFTER INSERT ON pendaftaran_lowongan FOR EACH ROW
            BEGIN
                DECLARE judul_lowongan VARCHAR(255);
                DECLARE msg text;

                SELECT lk.judul_lowongan INTO judul_lowongan FROM lowongan_kerja AS lk
                INNER JOIN pendaftaran_lowongan AS pl WHERE pl.id_lowongan = lk.id_lowongan;

                SET msg = CONCAT('Ada pelamar yang mendaftar di lowongan ', judul_lowongan);

                INSERT INTO pendaftaran_lowongan_log (
                    judul_lowongan,
                    id_pelamar,
                    kode_pendaftaran,
                    event,
                    keterangan
                ) VALUES (
                    judul_lowongan,
                    new.id_pelamar,
                    new.kode_pendaftaran,
                    'insert',
                    msg
                );
            END ;"
        );
    }
};
