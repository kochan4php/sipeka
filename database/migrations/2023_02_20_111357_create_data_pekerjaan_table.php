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
        Schema::create('data_pekerjaan', function (Blueprint $table) {
            $table->uuid('id_data_pekerjaan')->primary();
            $table->integer('id_pelamar');
            $table->integer('id_lowongan')->nullable();
            $table->string('judul_pekerjaan');
            $table->string('posisi');
            $table->text('lokasi_kantor');
            $table->timestamps();

            // Foreign key untuk id_pelamar
            $table
                ->foreign('id_pelamar')
                ->references('id_pelamar')
                ->on('pelamar')
                ->cascadeOnUpdate();

            // Foreign key untuk id_lowongan
            $table
                ->foreign('id_lowongan')
                ->references('id_lowongan')
                ->on('lowongan_kerja')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('data_pekerjaan');
    }
};
