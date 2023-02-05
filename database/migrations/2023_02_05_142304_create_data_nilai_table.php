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
    Schema::create('data_nilai', function (Blueprint $table) {
      $table->uuid('id_nilai')->primary();
      $table->integer('id_siswa');
      $table->string('nama_mapel');
      $table->tinyInteger('nilai_semester_1')->default(null);
      $table->tinyInteger('nilai_semester_2')->default(null);
      $table->tinyInteger('nilai_semester_3')->default(null);
      $table->tinyInteger('nilai_semester_4')->default(null);
      $table->tinyInteger('nilai_semester_5')->default(null);
      $table->tinyInteger('nilai_semester_6')->default(null);
      $table->tinyInteger('nilai_sekolah')->default(null);
      $table->tinyInteger('nilai_praktek')->default(null);
      $table->tinyInteger('nilai_ujian')->default(null);
      $table->tinyInteger('rata_rata')->default(null);
      $table->timestamps();

      // Foreign key untuk id_siswa
      $table
        ->foreign('id_siswa')
        ->references('id_siswa')
        ->on('siswa_alumni')
        ->cascadeOnUpdate();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('data_nilai');
  }
};
