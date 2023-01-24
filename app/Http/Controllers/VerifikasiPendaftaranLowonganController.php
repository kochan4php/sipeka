<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Models\PendaftaranLowongan;
use Illuminate\Http\Request;

final class VerifikasiPendaftaranLowonganController extends Controller {
  public function verification(Request $request, PendaftaranLowongan $pendaftaranLowongan) {
    try {
      $verification = $request->boolean('verification');
      $pendaftaranLowongan->update(['verifikasi' => $verification]);

      $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);

      return back()
        ->with('sukses', "Berhasil memverifikasi lamaran kerja dari {$namaPelamar}");
    } catch (\Exception $e) {
      return back()
        ->with('error', $e->getMessage());
    }
  }
}
