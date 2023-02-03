<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

final class MainController extends Controller {
  public function __invoke(): View {
    $jumlah_pengguna = collect(DB::select("SELECT * FROM jumlah_pengguna"))
      ->firstOrFail()
      ->jumlah_pengguna;

    $jumlah_alumni = collect(DB::select("SELECT * FROM jumlah_alumni"))
      ->firstOrFail()
      ->jumlah_alumni;

    $jumlah_mitra_perusahaan = collect(DB::select("SELECT * FROM jumlah_mitra_perusahaan"))
      ->firstOrFail()
      ->jumlah_mitra_perusahaan;

    $jumlah_lowongan = collect(DB::select("SELECT * FROM jumlah_lowongan"))
      ->firstOrFail()
      ->jumlah_lowongan;

    $jumlah_masyarakat = collect(DB::select("SELECT * FROM jumlah_masyarakat"))
      ->firstOrFail()
      ->jumlah_masyarakat;

    return view('admin.index', compact(
      'jumlah_pengguna',
      'jumlah_alumni',
      'jumlah_mitra_perusahaan',
      'jumlah_lowongan',
      'jumlah_masyarakat'
    ));
  }
}
