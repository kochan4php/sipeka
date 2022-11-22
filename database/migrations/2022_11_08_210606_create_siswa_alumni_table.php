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
    Schema::create('siswa_alumni', function (Blueprint $table) {
      $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
      $table->charset = env('DB_CHARSET', 'utf8');
      $table->collation = env('DB_COLLATION', 'utf8_unicode_ci');
      $table->integer('id_siswa', true);
      $table->integer('id_pelamar');
      $table->char('id_angkatan', 8);
      $table->char('id_jurusan', 7);
      $table->string('nis', 18);
      $table->string('nama_lengkap');
      $table->enum('jenis_kelamin', ['L', 'P']);
      $table->string('tempat_lahir', 100);
      $table->date('tanggal_lahir');
      $table->string('no_telepon', 20);
      $table->text('alamat_tempat_tinggal');
      $table->string('foto')->nullable();

      // Foreign key untuk id_pelamar
      $table
        ->foreign('id_pelamar')
        ->references('id_pelamar')
        ->on('pelamar')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

      // Foreign key untuk id_angkatan
      $table
        ->foreign('id_angkatan')
        ->references('id_angkatan')
        ->on('angkatan')
        ->cascadeOnUpdate()
        ->cascadeOnDelete();

      // Foreign key untuk id_jurusan
      $table
        ->foreign('id_jurusan')
        ->references('id_jurusan')
        ->on('jurusan')
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
    Schema::dropIfExists('siswa_alumni');
  }
};
