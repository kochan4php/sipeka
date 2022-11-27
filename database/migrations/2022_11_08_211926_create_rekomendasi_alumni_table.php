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
    // Ini pivot table yaa, artinya table pembantu dari relasi Many to Many
    Schema::create('rekomendasi_alumni', function (Blueprint $table) {
      $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
      $table->charset = env('DB_CHARSET', 'utf8mb4');
      $table->collation = env('DB_COLLATION', 'utf8mb4_general_ci');
      $table->integer('id_siswa');
      $table->integer('id_perusahaan');

      // Foreign key untuk id_siswa
      $table
        ->foreign('id_siswa')
        ->references('id_siswa')
        ->on('siswa_alumni')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

      // Foreign key untuk id_perusahaan
      $table
        ->foreign('id_perusahaan')
        ->references('id_perusahaan')
        ->on('mitra_perusahaan')
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
    Schema::dropIfExists('rekomendasi_alumni');
  }
};
