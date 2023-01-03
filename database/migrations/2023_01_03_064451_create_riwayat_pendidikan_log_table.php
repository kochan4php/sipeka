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
    Schema::create('riwayat_pendidikan_log', function (Blueprint $table) {
      $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
      $table->charset = env('DB_CHARSET', 'utf8mb4');
      $table->collation = env('DB_COLLATION', 'utf8mb4_general_ci');
      $table->id('nomor');
      $table->integer('id_pelamar');
      $table->string('kualifikasi');
      $table->string('institut_or_universitas');
      $table->string('tahun_kelulusan');
      $table->text('informasi_tambahan');
      $table->enum('event', ['insert', 'update', 'delete']);
      $table->text('keterangan');;
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('riwayat_pendidikan_log');
  }
};
