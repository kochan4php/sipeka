<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('lowongan_kerja', function (Blueprint $table) {
            $table->integer('id_lowongan', true);
            $table->integer('id_perusahaan');
            $table->string('jenis_pekerjaan', 100);
            $table->string('judul_lowongan');
            $table->string('posisi');
            $table->string('estimasi_gaji');
            $table->text('deskripsi_lowongan');
            $table->date('tanggal_berakhir');
            $table->string('slug')->unique();
            $table->text('banner')->nullable()->default(null);
            $table->text('public_banner_id')->nullable()->default(null);
            $table->boolean('active')->nullable()->default(null);
            $table->boolean('is_approve')->nullable()->default(null);
            $table->boolean('is_finished')->default(false);
            $table->timestamps();

            $table
                ->foreignUuid('lokasi_kerja')
                ->constrained('kantor', 'id_kantor')
                ->cascadeOnUpdate();

            // Foreign key untuk id_perusahaan
            $table
                ->foreign('id_perusahaan')
                ->references('id_perusahaan')
                ->on('mitra_perusahaan')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('lowongan_kerja');
    }
};
