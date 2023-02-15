<?php

declare(strict_types=1);

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Models\LowonganKerja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SiswaAlumni;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class RecomendationController extends Controller {
  public function getAllRecomendations(Request $request): View {
    $rekomendasi = null;
    $columns = [
      'sa.nama_lengkap',
      'sa.id_siswa',
      'rl.*',
      'lk.id_lowongan',
      'lk.judul_lowongan',
      'lk.posisi'
    ];

    if ($request->has('q')) {
      $rekomendasi = DB::table('rekomendasi_lowongan as rl')
        ->select($columns)
        ->join('siswa_alumni as sa', 'rl.id_siswa', '=', 'sa.id_siswa')
        ->join('lowongan_kerja as lk', 'rl.id_lowongan', '=', 'lk.id_lowongan')
        ->where('sa.nama_lengkap', 'LIKE', "%{$request->input('q')}%")
        ->orWhere('lk.judul_lowongan', 'LIKE', "%{$request->input('q')}%")
        ->orWhere('lk.posisi', 'LIKE', "%{$request->input('q')}%")
        ->latest('rl.created_at')
        ->paginate(10)
        ->withQueryString();
    } else {
      $rekomendasi = DB::table('rekomendasi_lowongan as rl')
        ->select($columns)
        ->join('siswa_alumni as sa', 'rl.id_siswa', '=', 'sa.id_siswa')
        ->join('lowongan_kerja as lk', 'rl.id_lowongan', '=', 'lk.id_lowongan')
        ->latest('rl.created_at')
        ->paginate(10)
        ->withQueryString();
    }

    return view('rekomendasi.index', compact('rekomendasi'));
  }

  public function createOneRecomendation(): View {
    $alumni = SiswaAlumni::all(['id_siswa', 'nama_lengkap']);
    $lowongan = LowonganKerja::latest()
      ->get(['id_lowongan', 'judul_lowongan', 'posisi']);

    return view('rekomendasi.tambah', compact('alumni', 'lowongan'));
  }

  public function storeOneRecomendation(Request $request): RedirectResponse {
    $judul = '';
    $deskripsi = '';
    $loker = LowonganKerja::with('perusahaan')->find($request->id_lowongan);

    $rules = [
      'id_siswa' => 'required|array|min:1',
      'id_lowongan' => 'required',
    ];

    if (!$request->boolean('automatic_msg')) {
      $rules['judul'] = 'required';
      $rules['deskripsi'] = 'required';
      $judul = $request->judul;
      $deskripsi = $request->deskripsi;
    } else {
      $judul = "Selamat anda direkomendasikan untuk posisi {$loker->posisi} dari loker {$loker->judul_lowongan}";
      $deskripsi = "Anda direkomendasikan untuk posisi {$loker->posisi} di loker {$loker->judul_lowongan} di perusahaan {$loker->perusahaan->nama_perusahaan}. Daftarkan diri anda sekarang, jangan sampai terlewatkan!";
    }

    $request->validate($rules);
    $alumni = $request->id_siswa;

    foreach ($alumni as $item) {
      DB::table('rekomendasi_lowongan')
        ->insert([
          'id_siswa' => $item,
          'id_lowongan' => $request->id_lowongan,
          'judul' => $judul,
          'deskripsi' => $deskripsi,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);
    }

    notify()->success('Berhasil menambahkan rekomendasi baru', 'Notifikasi');

    return to_route('rekomendasi.index');
  }

  public function deleteOneRecomendation(string $siswa, string $lowongan): RedirectResponse {
    DB::table('rekomendasi_lowongan')
      ->where('rekomendasi_lowongan.id_siswa', '=', decrypt($siswa))
      ->where('rekomendasi_lowongan.id_lowongan', '=', decrypt($lowongan))
      ->delete();

    notify()->success('Berhasil menghapus data rekomendasi', 'Notifikasi');

    return back();
  }
}
