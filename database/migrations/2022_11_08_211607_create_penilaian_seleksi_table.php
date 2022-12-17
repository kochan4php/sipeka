<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('penilaian_seleksi', function (Blueprint $table) {
      $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
      $table->charset = env('DB_CHARSET', 'utf8mb4');
      $table->collation = env('DB_COLLATION', 'utf8mb4_general_ci');
      $table->uuid('id_penilaian_seleksi')->primary();
      $table->integer('id_pelamar');

      // Foreign key untuk id_tahapan
      $table
        ->foreignUuid('id_tahapan')
        ->constrained('tahapan_seleksi', 'id_tahapan')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

      // Foreign key untuk id_pendaftaran
      $table
        ->foreignUuid('id_pendaftaran')
        ->constrained('pendaftaran_lowongan', 'id_pendaftaran')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

      $table->tinyInteger('nilai');
      $table->enum('keterangan', ['Lulus', 'Gagal']);
      $table->enum('is_lanjut', ['Ya', 'Tidak']);

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
  public function down()
  {
    Schema::dropIfExists('penilaian_seleksi');
  }
};
