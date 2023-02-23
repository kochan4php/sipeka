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
        Schema::create('masyarakat', function (Blueprint $table) {
            $table->integer('id_masyarakat', true);
            $table->integer('id_pelamar');
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_telepon', 20)->nullable()->default(null);
            $table->string('tempat_lahir', 100)->nullable()->default(null);
            $table->date('tanggal_lahir')->nullable()->default(null);
            $table->text('alamat_tempat_tinggal')->nullable()->default(null);
            $table->text('foto')->nullable()->default(null);
            $table->text('public_foto_id')->nullable()->default(null);
            $table->boolean('is_active')->nullable()->default(true);

            // Foreign key untuk id_pelamar
            $table
                ->foreign('id_pelamar')
                ->references('id_pelamar')
                ->on('pelamar')
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('masyarakat');
    }
};
