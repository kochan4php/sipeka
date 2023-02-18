<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\PendaftaranLowongan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PendaftaranLowonganController extends Controller {
  public function getAllJobRegistrationData(): View {
    $pendaftaranLowongan = PendaftaranLowongan::latest()
      ->notYetVerified()
      ->paginate(10);
    return view('admin.pendaftaran-lowongan.index', compact('pendaftaranLowongan'));
  }

  public function jobVacancyRegistrationApproval(PendaftaranLowongan $pendaftaranLowongan): RedirectResponse {
    $explodeURL = explode('/', URL::full());
    $status = '';
    $verifikasi = end($explodeURL);

    if ($verifikasi === 'setujui') {
      $pendaftaranLowongan->update(['verifikasi' => 'Sudah']);
      $status = 'menyetujui';
    } else if ($verifikasi === 'tolak') {
      $pendaftaranLowongan->update(['verifikasi' => 'Ditolak']);
      $status = 'menolak';
    }

    $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);

    notify()->success("Berhasil {$status} lamaran kerja dari {$namaPelamar}", 'Notifikasi');

    return back();
  }
}
