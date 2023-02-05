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
    Schema::create('mitra_perusahaan', function (Blueprint $table) {
      $table->integer('id_perusahaan', true);
      $table->integer('id_user');
      $table->string('nama_perusahaan');
      $table->string('nomor_telp_perusahaan');
      $table->string('foto_sampul_perusahaan')->nullable()->default(null);
      $table->string('logo_perusahaan')->nullable()->default(null);
      $table->text('deskripsi_perusahaan')->nullable()->default(null);
      $table->enum('jenis_perusahaan', ['PT', 'CV', 'Firma', 'Persero']);
      $table->string('kategori_perusahaan');
      $table->boolean('is_blocked')->default(false);
      $table->boolean('is_active')->nullable()->default(true);

      // Foreign key untuk id_user
      $table
        ->foreign('id_user')
        ->references('id_user')
        ->on('users')
        ->cascadeOnUpdate();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('mitra_perusahaan');
  }
};
