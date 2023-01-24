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
    Schema::create('kantor', function (Blueprint $table) {
      $table->uuid('id_kantor')->primary();
      $table->integer('id_perusahaan');
      $table->text('alamat_kantor');
      $table->string('wilayah_kantor');
      $table->enum('status_kantor', ['Kantor Pusat', 'Kantor Cabang']);
      $table->string('no_telp_kantor', 100);
      $table->boolean('kantor_utama')->default(false);
      $table->timestamps();

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
  public function down() {
    Schema::dropIfExists('kantor');
  }
};
