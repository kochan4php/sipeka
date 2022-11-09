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
    Schema::create('riwayat_pendidikan_pengguna', function (Blueprint $table) {
      $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
      $table->integer('id_riwayat', true);
      $table->char('id_tingkatan', 8);
      $table->integer('id_pelamar');
      $table->string('nama_institut');

      // Foreign key untuk id_tingkatan
      $table
        ->foreign('id_tingkatan')
        ->references('id_tingkatan')
        ->on('tingkatan_pendidikan')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

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
    Schema::dropIfExists('riwayat_pendidikan_pengguna');
  }
};
