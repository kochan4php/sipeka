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
    public function up(): void {
        Schema::create('lowongan_log', function (Blueprint $table) {
            $table->engine = env('DB_STORAGE_ENGINE', 'InnoDB');
            $table->charset = env('DB_CHARSET', 'utf8mb4');
            $table->collation = env('DB_COLLATION', 'utf8mb4_general_ci');
            $table->id('nomor');
            $table->string('nama_perusahaan');
            $table->string('judul_lowongan');
            $table->text('deskripsi_lowongan');
            $table->date('tanggal_berakhir');
            $table->text('slug');
            $table->enum('event', ['insert', 'update']);
            $table->text('keterangan');;
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('lowongan_log');
    }
};
