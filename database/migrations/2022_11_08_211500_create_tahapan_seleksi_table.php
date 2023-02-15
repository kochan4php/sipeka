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
    Schema::create('tahapan_seleksi', function (Blueprint $table) {
      $table->uuid('id_tahapan')->primary();
      $table->integer('id_lowongan');
      $table->string('judul_tahapan', 200);
      $table->text('ket_tahapan');
      $table->integer('urutan_tahapan_ke');
      $table->date('tanggal_dimulai');
      $table->boolean('is_approve')->nullable();

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
    Schema::dropIfExists('tahapan_seleksi');
  }
};
