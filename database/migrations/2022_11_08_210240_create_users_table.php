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
    Schema::create('users', function (Blueprint $table) {
      $table->integer('id_user', true);
      $table->char('id_level', 4);
      $table->string('username')->unique();
      $table->string('email')->unique()->nullable()->default(null);
      $table->string('password');
      $table->rememberToken();

      // Foreign key untuk id_level
      $table
        ->foreign('id_level')
        ->references('id_level')
        ->on('level_user')
        ->cascadeOnUpdate();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('users');
  }
};
