<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    DB::unprepared(
      "CREATE OR REPLACE VIEW jumlah_pengguna AS (
        SELECT count(users.id_user) AS jumlah_pengguna FROM users
      )"
    );
  }
};
