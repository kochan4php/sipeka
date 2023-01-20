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
    Schema::create('pengalaman_kerja', function (Blueprint $table) {
      $table->integer('id_pengalaman', true);
      $table->integer('id_pelamar');
      $table->integer('id_jenis_pekerjaan');
      $table->string('judul_posisi');
      $table->string('nama_perusahaan');
      $table->date('tanggal_masuk');
      $table->date('tanggal_selesai');
      $table->text('deskripsi_pengalaman');

      // Foreign key untuk id_pelamar
      $table
        ->foreign('id_pelamar')
        ->references('id_pelamar')
        ->on('pelamar')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

      // Foreign key untuk id_jenis_pekerjaan
      $table
        ->foreign('id_jenis_pekerjaan')
        ->references('id_jenis_pekerjaan')
        ->on('jenis_pekerjaan')
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
    Schema::dropIfExists('pengalaman_bekerja');
  }
};
