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
    Schema::create('lowongan_kerja', function (Blueprint $table) {
      $table->integer('id_lowongan', true);
      $table->integer('id_perusahaan');
      $table->integer('id_jenis_pekerjaan');
      $table->string('judul_lowongan');
      $table->string('posisi');
      $table->string('estimasi_gaji');
      $table->text('deskripsi_lowongan');
      $table->date('tanggal_berakhir');
      $table->text('slug')->unique();
      $table->boolean('is_approve')->nullable()->default(false);
      $table->boolean('active')->nullable()->default(true);
      $table->timestamps();

      // Foreign key untuk id_perusahaan
      $table
        ->foreign('id_perusahaan')
        ->references('id_perusahaan')
        ->on('mitra_perusahaan')
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
    Schema::dropIfExists('lowongan_kerja');
  }
};
