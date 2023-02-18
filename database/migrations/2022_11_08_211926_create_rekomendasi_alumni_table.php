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
        // Ini pivot table yaa, artinya table pembantu dari relasi Many to Many
        Schema::create('rekomendasi_alumni', function (Blueprint $table) {
            $table->integer('id_siswa');
            $table->integer('id_perusahaan');
            $table->string('judul');
            $table->text('deskripsi');

            // Foreign key untuk id_siswa
            $table
                ->foreign('id_siswa')
                ->references('id_siswa')
                ->on('siswa_alumni')
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
        Schema::dropIfExists('rekomendasi_alumni');
    }
};
