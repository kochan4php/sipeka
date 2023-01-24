<?php

namespace App\Http\Controllers\Pelamar;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\NotifikasiSeleksi;
use App\Models\Pelamar;
use App\Models\PendaftaranLowongan;
use App\Models\PenilaianSeleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class PendaftaranLowonganController extends Controller {
  public function index() {
    $data = UserHelper::getApplicantData(Auth::user()->pelamar);
    $pendaftaranLowongan = $data->pelamar->pendaftaran_lowongan;
    return view('pelamar.lamaran_kerja.index', compact('pendaftaranLowongan'));
  }

  public function show(string $username, PendaftaranLowongan $pendaftaranLowongan) {
    $penilaianSeleksi = PenilaianSeleksi::where([
      'id_pelamar' => Auth::user()->pelamar->id_pelamar,
      'id_pendaftaran' => $pendaftaranLowongan->id_pendaftaran
    ])->get();

    $notifikasiSeleksi = NotifikasiSeleksi::where('id_pelamar', Auth::user()->pelamar->id_pelamar)
      ->latest()
      ->first();

    return view(
      'pelamar.lamaran_kerja.detail',
      compact('pendaftaranLowongan', 'penilaianSeleksi', 'notifikasiSeleksi')
    );
  }

  public function PDFVerifikasi(string $username, PendaftaranLowongan $pendaftaranLowongan) {
    $penilaianSeleksi = PenilaianSeleksi::where([
      'id_pelamar' => Auth::user()->pelamar->id_pelamar,
      'id_pendaftaran' => $pendaftaranLowongan->id_pendaftaran
    ])->get();

    return view(
      'pelamar.lamaran_kerja.pdf.pdf_verifikasi',
      compact('pendaftaranLowongan', 'penilaianSeleksi')
    );
  }
}
