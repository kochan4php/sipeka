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
            "CREATE OR REPLACE TRIGGER tambah_mitra_baru AFTER INSERT ON mitra_perusahaan FOR EACH ROW
            BEGIN
                DECLARE nama_perusahaan VARCHAR(255);

                SET nama_perusahaan = CONCAT(new.jenis_perusahaan, '. ', new.nama_perusahaan);

                INSERT INTO perusahaan_log (
                    nama_perusahaan,
                    nomor_telp_perusahaan,
                    event,
                    keterangan
                ) VALUES (
                    nama_perusahaan,
                    new.nomor_telp_perusahaan,
                    'insert',
                    'Mitra baru berhasil ditambahkan'
                );
            END ;"
        );
    }
};
