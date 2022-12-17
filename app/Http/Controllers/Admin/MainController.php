<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
  public function __invoke()
  {
    $jumlah_pengguna = collect(DB::select("SELECT * FROM jumlah_pengguna"))
      ->firstOrFail()
      ->jumlah_pengguna;

    $jumlah_alumni = collect(DB::select("SELECT * FROM jumlah_alumni"))
      ->firstOrFail()
      ->jumlah_alumni;

    $jumlah_masyarakat = collect(DB::select("SELECT * FROM jumlah_masyarakat"))
      ->firstOrFail()
      ->jumlah_masyarakat;

    $jumlah_mitra_perusahaan = collect(DB::select("SELECT * FROM jumlah_mitra_perusahaan"))
      ->firstOrFail()
      ->jumlah_mitra_perusahaan;

    $jumlah_jurusan = collect(DB::select("SELECT * FROM jumlah_jurusan"))
      ->firstOrFail()
      ->jumlah_jurusan;

    $jumlah_angkatan = collect(DB::select("SELECT * FROM jumlah_angkatan"))
      ->firstOrFail()
      ->jumlah_angkatan;

    $jumlah_lowongan = collect(DB::select("SELECT * FROM jumlah_lowongan"))
      ->firstOrFail()
      ->jumlah_lowongan;

    return view('admin.index', compact(
      'jumlah_pengguna',
      'jumlah_alumni',
      'jumlah_masyarakat',
      'jumlah_mitra_perusahaan',
      'jumlah_jurusan',
      'jumlah_angkatan',
      'jumlah_lowongan',
    ));
  }
}
