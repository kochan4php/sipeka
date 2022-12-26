<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranLowongan;
use Illuminate\Http\Request;

class VerifikasiPendaftaranLowonganController extends Controller
{
  public function verification(Request $request, PendaftaranLowongan $pendaftaranLowongan)
  {
    try {
      $verification = $request->boolean('verification');
      $pendaftaranLowongan->update(['verifikasi' => $verification]);

      $namaPelamar = $pendaftaranLowongan->pelamar->alumni ?
        $pendaftaranLowongan->pelamar->alumni->nama_lengkap :
        $pendaftaranLowongan->pelamar->masyarakat->nama_lengkap;

      return back()->with('sukses', "Berhasil memverifikasi lamaran kerja dari {$namaPelamar}");
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
