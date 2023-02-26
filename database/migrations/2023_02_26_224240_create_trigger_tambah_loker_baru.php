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
            "CREATE OR REPLACE TRIGGER tambah_loker_baru AFTER INSERT ON lowongan_kerja FOR EACH ROW
            BEGIN
                DECLARE nama_perusahaan VARCHAR(255);
                DECLARE jenis_perusahaan enum('PT', 'CV', 'Firma', 'Persero');

                SELECT mp.nama_perusahaan INTO nama_perusahaan FROM mitra_perusahaan AS mp
                WHERE mp.id_perusahaan = new.id_perusahaan;

                SELECT mp.jenis_perusahaan INTO jenis_perusahaan FROM mitra_perusahaan AS mp
                WHERE mp.id_perusahaan = new.id_perusahaan;

                SET nama_perusahaan = CONCAT(jenis_perusahaan, '. ', nama_perusahaan);

                INSERT INTO lowongan_log (
                    nama_perusahaan,
                    judul_lowongan,
                    deskripsi_lowongan,
                    tanggal_berakhir,
                    slug,
                    event,
                    keterangan,
                    created_at
                ) VALUES (
                    nama_perusahaan,
                    new.judul_lowongan,
                    new.deskripsi_lowongan,
                    new.tanggal_berakhir,
                    new.slug,
                    'insert',
                    'Lowongan Kerja baru berhasil ditambahkan',
                    NOW()
                );
            END ;"
        );
    }
};
