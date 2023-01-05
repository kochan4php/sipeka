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
      $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
      $table->charset = env('DB_CHARSET', 'utf8mb4');
      $table->collation = env('DB_COLLATION', 'utf8mb4_general_ci');
      $table->uuid('id_tahapan')->primary();
      $table->integer('id_lowongan');
      $table->string('judul_tahapan', 200);
      $table->text('ket_tahapan');
      $table->integer('urutan_tahapan_ke');

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
