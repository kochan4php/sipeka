<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};

class RecomendationController extends Controller {
    public function getAllRecomendation(): View {
        $rekomendasi = DB::table('rekomendasi_lowongan as rl')
            ->select()
            ->join('siswa_alumni as sa', 'rl.id_siswa', '=', 'sa.id_siswa')
            ->join('lowongan_kerja as lk', 'rl.id_lowongan', '=', 'lk.id_lowongan')
            ->where('sa.id_siswa', '=', Auth::user()->alumni->id_siswa)
            ->latest('rl.created_at')
            ->paginate(10);

        return view('pelamar.alumni.rekomendasi.index', compact('rekomendasi'));
    }

    public function getDetailRecomendation(string $username, string $siswa, string $lowongan): View {
        $columns = [
            'sa.*',
            'lk.*',
            'rl.judul',
            'rl.deskripsi',
            'rl.created_at',
            'mp.nama_perusahaan',
            'mp.jenis_perusahaan',
            'mp.logo_perusahaan'
        ];

        $rekomendasi = DB::table('rekomendasi_lowongan as rl')
            ->select($columns)
            ->join('siswa_alumni as sa', 'rl.id_siswa', '=', 'sa.id_siswa')
            ->join('lowongan_kerja as lk', 'rl.id_lowongan', '=', 'lk.id_lowongan')
            ->join('mitra_perusahaan as mp', 'lk.id_perusahaan', '=', 'mp.id_perusahaan')
            ->where('sa.id_siswa', '=', Auth::user()->alumni->id_siswa)
            ->where('lk.id_lowongan', '=', decrypt($lowongan))
            ->first();

        return view('pelamar.alumni.rekomendasi.detail', compact('rekomendasi'));
    }
}
