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
    Schema::create('kandidat_luar_log', function (Blueprint $table) {
      $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
      $table->charset = env('DB_CHARSET', 'utf8mb4');
      $table->collation = env('DB_COLLATION', 'utf8mb4_general_ci');
      $table->id('nomor');
      $table->integer('id_pelamar');
      $table->string('nama');
      $table->string('no_telepon', 20);
      $table->enum('jenis_kelamin', ['L', 'P']);
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
    Schema::dropIfExists('kandidat_luar_log');
  }
};
