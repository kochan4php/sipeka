<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pelamar;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\PendaftaranLowongan;
use App\Models\PenilaianSeleksi;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

final class PendaftaranLowonganController extends Controller {
    public function index(): View {
        $data = UserHelper::getApplicantData(Auth::user()->pelamar);
        $pendaftaranLowongan = $data->pelamar->pendaftaran_lowongan;
        $data = [];

        if (Auth::check() && Auth::user()->alumni) $data = Auth::user()->alumni;
        else $data = Auth::user()->masyarakat;

        return view('pelamar.lamaran_kerja.index', compact('pendaftaranLowongan', 'data'));
    }

    public function show(string $username, PendaftaranLowongan $pendaftaranLowongan): View {
        $penilaianSeleksi = PenilaianSeleksi::where([
            'id_pelamar' => Auth::user()->pelamar->id_pelamar,
            'id_pendaftaran' => $pendaftaranLowongan->id_pendaftaran
        ])->get();
        $data = [];

        if (Auth::check() && Auth::user()->alumni) $data = Auth::user()->alumni;
        else $data = Auth::user()->masyarakat;

        return view('pelamar.lamaran_kerja.detail', compact('pendaftaranLowongan', 'penilaianSeleksi', 'data'));
    }

    public function PDFVerifikasi(string $username, PendaftaranLowongan $pendaftaranLowongan): View {
        $penilaianSeleksi = PenilaianSeleksi::where([
            'id_pelamar' => Auth::user()->pelamar->id_pelamar,
            'id_pendaftaran' => $pendaftaranLowongan->id_pendaftaran
        ])->get();
        $data = [];

        if (Auth::check() && Auth::user()->alumni) $data = Auth::user()->alumni;
        else $data = Auth::user()->masyarakat;

        return view('pelamar.lamaran_kerja.pdf.pdf_verifikasi', compact('pendaftaranLowongan', 'penilaianSeleksi', 'data'));
    }
}
