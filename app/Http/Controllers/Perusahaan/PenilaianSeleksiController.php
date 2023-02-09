<?php

namespace App\Http\Controllers\Perusahaan;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\Tahapan\StorePenilaianSeleksiRequest;
use App\Models\Dokumen;
use App\Models\PendaftaranLowongan;
use App\Models\PenilaianSeleksi;
use App\Models\TahapanSeleksi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class PenilaianSeleksiController extends Controller {
  private function getIdPendaftaran(PendaftaranLowongan $pendaftaranLowongan): string {
    return $pendaftaranLowongan->id_pendaftaran;
  }

  public function index(): View {
    $jenisDokumen = Dokumen::all();
    $pendaftaranLowongan = Auth::user()
      ->perusahaan
      ->pendaftaran_lowongan
      ->where('verifikasi', 'Sudah')
      ->latest()
      ->get();

    return view('seleksi.penilaian.index', compact('pendaftaranLowongan', 'jenisDokumen'));
  }

  public function jobApplicationDetails(PendaftaranLowongan $pendaftaranLowongan): View {
    $dataPelamar = UserHelper::getApplicantData($pendaftaranLowongan->pelamar);
    $namaPelamar = $dataPelamar->nama_lengkap;

    return view('seleksi.penilaian.job_application_details', compact('pendaftaranLowongan', 'namaPelamar', 'dataPelamar'));
  }

  public function passApplicants(PendaftaranLowongan $pendaftaranLowongan): RedirectResponse {
    try {
      $pendaftaranLowongan->update(['status_seleksi' => 'Lulus']);
      $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);

      return to_route('penilaian.seleksi.index')
        ->with('sukses', "Berhasil meluluskan {$namaPelamar}");
    } catch (\Exception $e) {
      return to_route('penilaian.seleksi.index')
        ->with('error', $e->getMessage());
    }
  }

  public function create(PendaftaranLowongan $pendaftaranLowongan, TahapanSeleksi $tahapanSeleksi): View {
    $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);

    return view('seleksi.penilaian.create', compact('pendaftaranLowongan', 'namaPelamar', 'tahapanSeleksi'));
  }

  public function store(
    StorePenilaianSeleksiRequest $request,
    PendaftaranLowongan $pendaftaranLowongan,
    TahapanSeleksi $tahapanSeleksi
  ): RedirectResponse {
    try {
      $validatedData = $request->validatedData();
      $validatedData['id_pelamar'] = $pendaftaranLowongan->pelamar->id_pelamar;
      $validatedData['id_tahapan'] = $tahapanSeleksi->id_tahapan;
      $validatedData['id_pendaftaran'] = $pendaftaranLowongan->id_pendaftaran;
      PenilaianSeleksi::create($validatedData);

      if ($validatedData['keterangan'] === 'Gagal' || $validatedData['is_lanjut'] === 'Tidak') {
        $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);
        $pendaftaranLowongan->update(['status_seleksi' => 'Tidak']);

        return to_route('penilaian.seleksi.index')->with('sukses', "Berhasil menggagalkan {$namaPelamar}");
      }

      $pendaftaran_lowongan = $this->getIdPendaftaran($pendaftaranLowongan);

      return to_route('penilaian.seleksi.job_application_details', compact('pendaftaran_lowongan'))
        ->with('sukses', "Berhasil memberi penilaian untuk tahapan seleksi {$tahapanSeleksi->judul_tahapan}");
    } catch (\Exception $e) {
      return to_route('penilaian.seleksi.job_application_details', compact('pendaftaran_lowongan'))
        ->with('error', $e->getMessage());
    }
  }

  public function edit(
    PendaftaranLowongan $pendaftaranLowongan,
    TahapanSeleksi $tahapanSeleksi,
    PenilaianSeleksi $penilaianSeleksi
  ): View {
    $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);
    return view('seleksi.penilaian.edit', compact('pendaftaranLowongan', 'tahapanSeleksi', 'penilaianSeleksi', 'namaPelamar'));
  }

  public function update(
    StorePenilaianSeleksiRequest $request,
    PendaftaranLowongan $pendaftaranLowongan,
    TahapanSeleksi $tahapanSeleksi,
    PenilaianSeleksi $penilaianSeleksi
  ): RedirectResponse {
    try {
      $validatedData = $request->validatedData();
      $penilaianSeleksi->update($validatedData);

      $pendaftaran_lowongan = $this->getIdPendaftaran($pendaftaranLowongan);

      return to_route('penilaian.seleksi.job_application_details', compact('pendaftaran_lowongan'))
        ->with('sukses', "Berhasil mengedit penilaian untuk tahapan seleksi {$tahapanSeleksi->judul_tahapan}");
    } catch (\Exception $e) {
      return to_route('penilaian.seleksi.job_application_details', compact('pendaftaran_lowongan'))
        ->with('error', $e->getMessage());
    }
  }
}
