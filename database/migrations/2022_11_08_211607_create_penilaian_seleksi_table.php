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
      $table->integer('id_penilaian_seleksi', true);
      $table->integer('id_pelamar');
      $table->integer('id_tahapan');
      $table->integer('id_pendaftaran');
      $table->smallInteger('nilai');
      $table->enum('keterangan', ['Lulus', 'Gagal']);
      $table->enum('is_lanjut', ['Ya', 'Tidak']);

      // Foreign key untuk id_pelamar
      $table
        ->foreign('id_pelamar')
        ->references('id_pelamar')
        ->on('pelamar')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

      // Foreign key untuk id_tahapan
      $table
        ->foreign('id_tahapan')
        ->references('id_tahapan')
        ->on('tahapan_seleksi')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

      // Foreign key untuk id_pendaftaran
      $table
        ->foreign('id_pendaftaran')
        ->references('id_pendaftaran')
        ->on('pendaftaran_lowongan')
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
