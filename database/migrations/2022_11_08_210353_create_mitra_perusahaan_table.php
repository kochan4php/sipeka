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
    Schema::create('mitra_perusahaan', function (Blueprint $table) {
      $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
      $table->charset = env('DB_CHARSET', 'utf8');
      $table->collation = env('DB_COLLATION', 'utf8_unicode_ci');
      $table->integer('id_perusahaan', true);
      $table->integer('id_user');
      $table->string('nama_perusahaan');
      $table->string('nomor_telp_perusahaan');
      $table->string('thumbnail_perusahaan')->nullable();
      $table->string('logo_perusahaan')->nullable();
      $table->text('deskripsi_perusahaan')->nullable();
      $table->text('alamat_perusahaan');

      // Foreign key untuk id_user
      $table
        ->foreign('id_user')
        ->references('id_user')
        ->on('users')
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
    Schema::dropIfExists('mitra_perusahaan');
  }
};
