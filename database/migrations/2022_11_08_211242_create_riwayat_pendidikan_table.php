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
    Schema::create('riwayat_pendidikan', function (Blueprint $table) {
      $table->uuid('id_riwayat')->primary();

      // Foreign key untuk kualifikasi
      $table
        ->foreignUuid('kualifikasi')
        ->constrained('gelar_pendidikan', 'id_gelar')
        ->cascadeOnDelete();

      $table->integer('id_pelamar');
      $table->string('institut_or_universitas');
      $table->string('tahun_kelulusan');
      $table->text('informasi_tambahan');

      // Foreign key untuk id_pelamar
      $table
        ->foreign('id_pelamar')
        ->references('id_pelamar')
        ->on('pelamar')
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
    Schema::dropIfExists('riwayat_pendidikan_pengguna');
  }
};
