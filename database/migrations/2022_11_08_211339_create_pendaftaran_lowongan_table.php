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
  public function up() {
    Schema::create('pendaftaran_lowongan', function (Blueprint $table) {
      $table->uuid('id_pendaftaran')->primary();
      $table->integer('id_pelamar');
      $table->integer('id_lowongan');
      $table->char('kode_pendaftaran', 20);
      $table->string('surat_lamaran_kerja');
      $table->enum('verifikasi', ['Sudah', 'Belum'])->default('Belum');
      $table->enum('status_seleksi', [
        'Lulus',
        'Tidak',
        'Belum tuntas mengikuti seleksi'
      ])->default('Belum tuntas mengikuti seleksi');
      $table->text('applicant_promotion')->nullable()->default(null);
      $table->boolean('is_active')->nullable()->default(true);

      // Foreign key untuk id_pelamar
      $table
        ->foreign('id_pelamar')
        ->references('id_pelamar')
        ->on('pelamar')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

      // Foreign key untuk id_lowongan
      $table
        ->foreign('id_lowongan')
        ->references('id_lowongan')
        ->on('lowongan_kerja')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('pendaftaran_lowongan');
  }
};
