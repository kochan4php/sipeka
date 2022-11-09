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
    Schema::create('rekomendasi_lowongan', function (Blueprint $table) {
      $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
      $table->char('id_jurusan', 7);
      $table->integer('id_lowongan');

      // Foreign key untuk id_jurusan
      $table
        ->foreign('id_jurusan')
        ->references('id_jurusan')
        ->on('jurusan')
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
  public function down()
  {
    Schema::dropIfExists('rekomendasi_lowongan');
  }
};
