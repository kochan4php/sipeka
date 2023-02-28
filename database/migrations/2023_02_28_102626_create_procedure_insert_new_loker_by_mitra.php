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
            "CREATE OR REPLACE PROCEDURE insert_new_loker_by_mitra (
                id_perusahaan int,
                judul_lowongan VARCHAR(255),
                posisi VARCHAR(255),
                estimasi_gaji VARCHAR(255),
                jenis_pekerjaan VARCHAR(100),
                lokasi_kerja VARCHAR(36),
                deskripsi_lowongan text,
                tanggal_berakhir DATE,
                slug text,
                banner text,
                public_banner_id text
            )
            BEGIN
                INSERT INTO lowongan_kerja (
                    id_perusahaan,
                    judul_lowongan,
                    posisi,
                    estimasi_gaji,
                    jenis_pekerjaan,
                    lokasi_kerja,
                    deskripsi_lowongan,
                    tanggal_berakhir,
                    slug,
                    banner,
                    public_banner_id
                ) VALUES (
                    id_perusahaan,
                    judul_lowongan,
                    posisi,
                    estimasi_gaji,
                    jenis_pekerjaan,
                    lokasi_kerja,
                    deskripsi_lowongan,
                    tanggal_berakhir,
                    slug,
                    banner,
                    public_banner_id
                );
            END ;"
        );
    }
};
