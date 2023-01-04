<?php

namespace App\Http\Controllers\Pelamar;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Models\PendaftaranLowongan;
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
}
