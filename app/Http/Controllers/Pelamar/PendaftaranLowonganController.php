<?php

namespace App\Http\Controllers\Pelamar;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Models\PendaftaranLowongan;
use App\Models\PenilaianSeleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranLowonganController extends Controller {
  private function getApplicantData(Pelamar $pelamar): object {
    return $pelamar->alumni ? $pelamar->alumni : $pelamar->masyarakat;
  }

  public function index() {
    $data = $this->getApplicantData(Auth::user()->pelamar);
    $pendaftaranLowongan = $data->pelamar->pendaftaran_lowongan;
    return view('pelamar.lamaran_kerja.index', compact('pendaftaranLowongan'));
  }

  public function show(string $username, PendaftaranLowongan $pendaftaranLowongan) {
    $penilaianSeleksi = PenilaianSeleksi::where([
      'id_pelamar' => Auth::user()->pelamar->id_pelamar,
      'id_pendaftaran' => $pendaftaranLowongan->id_pendaftaran
    ])->get();
    return view('pelamar.lamaran_kerja.detail', compact('pendaftaranLowongan', 'penilaianSeleksi'));
  }
}
