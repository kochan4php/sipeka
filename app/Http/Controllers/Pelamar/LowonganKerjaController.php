<?php

namespace App\Http\Controllers\Pelamar;

use App\Helpers\Helper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\LowonganKerja;
use App\Models\PendaftaranLowongan;
use Illuminate\Support\Facades\Auth;

class LowonganKerjaController extends Controller {
  public function show(LowonganKerja $lowonganKerja) {
    $lowongan = LowonganKerja::where('slug', '!=', $lowonganKerja->slug)->inRandomOrder()->limit(10)->get();
    $registeredApplicantId = PendaftaranLowongan::firstWhere([
      'id_pelamar' => UserHelper::getApplicantData(Auth::user()->pelamar)->pelamar->id_pelamar,
      'id_lowongan' => $lowonganKerja->id_lowongan,
    ])?->id_pelamar;

    return view('lowongan', compact('lowonganKerja', 'lowongan', 'registeredApplicantId'));
  }

  public function applyJob(LowonganKerja $lowonganKerja) {
    try {
      $id_pelamar = UserHelper::getApplicantData(Auth::user()->pelamar)->pelamar->id_pelamar;
      $id_lowongan = $lowonganKerja->id_lowongan;
      $kode_pendaftaran = Helper::generateUniqueCode('LMRN', length: 15);
      $validatedData = compact('id_pelamar', 'id_lowongan', 'kode_pendaftaran');

      PendaftaranLowongan::create($validatedData);

      return back()
        ->with('sukses', "Berhasil mendaftar di lowongan {$lowonganKerja->judul_lowongan}");
    } catch (\Exception $e) {
      return back()
        ->with('error', $e->getMessage());
    }
  }
}
