<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\Tahapan\StorePenilaianSeleksiRequest;
use App\Models\Dokumen;
use App\Models\PendaftaranLowongan;
use App\Models\PenilaianSeleksi;
use App\Models\TahapanSeleksi;

class PenilaianSeleksiController extends Controller {
  public function index() {
    $pendaftaranLowongan = PendaftaranLowongan::all();
    $jenisDokumen = Dokumen::all();
    return view('seleksi.penilaian.index', compact('pendaftaranLowongan', 'jenisDokumen'));
  }

  public function jobApplicationDetails(PendaftaranLowongan $pendaftaranLowongan) {
    $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);
    return view('seleksi.penilaian.job_application_details', compact('pendaftaranLowongan', 'namaPelamar'));
  }

  public function passApplicants(PendaftaranLowongan $pendaftaranLowongan) {
    try {
      $pendaftaranLowongan->update(['status_seleksi' => 'Lulus']);
      $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);

      return to_route('penilaian.seleksi.index')->with('sukses', "Berhasil meluluskan {$namaPelamar}");
    } catch (\Exception $e) {
      return to_route('penilaian.seleksi.index')->with('error', $e->getMessage());
    }
  }

  public function create(PendaftaranLowongan $pendaftaranLowongan, TahapanSeleksi $tahapanSeleksi) {
    $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);
    return view('seleksi.penilaian.create', compact('pendaftaranLowongan', 'namaPelamar', 'tahapanSeleksi'));
  }

  public function store(
    StorePenilaianSeleksiRequest $request,
    PendaftaranLowongan $pendaftaranLowongan,
    TahapanSeleksi $tahapanSeleksi
  ) {
    try {
      $validatedData = $request->validatedData();
      $validatedData['id_pelamar'] = $pendaftaranLowongan->pelamar->id_pelamar;
      $validatedData['id_tahapan'] = $tahapanSeleksi->id_tahapan;
      $validatedData['id_pendaftaran'] = $pendaftaranLowongan->id_pendaftaran;
      PenilaianSeleksi::create($validatedData);

      return to_route(
        'penilaian.seleksi.job_application_details',
        ['pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran]
      )->with('sukses', "Berhasil memberi penilaian untuk tahapan seleksi {$tahapanSeleksi->judul_tahapan}");
    } catch (\Exception $e) {
      return to_route(
        'penilaian.seleksi.job_application_details',
        ['pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran]
      )->with('error', $e->getMessage());
    }
  }

  public function edit(
    PendaftaranLowongan $pendaftaranLowongan,
    TahapanSeleksi $tahapanSeleksi,
    PenilaianSeleksi $penilaianSeleksi
  ) {
    $namaPelamar = UserHelper::getApplicantName($pendaftaranLowongan->pelamar);
    return view('seleksi.penilaian.edit', compact('pendaftaranLowongan', 'tahapanSeleksi', 'penilaianSeleksi', 'namaPelamar'));
  }

  public function update(
    StorePenilaianSeleksiRequest $request,
    PendaftaranLowongan $pendaftaranLowongan,
    TahapanSeleksi $tahapanSeleksi,
    PenilaianSeleksi $penilaianSeleksi
  ) {
    try {
      $validatedData = $request->validatedData();
      $penilaianSeleksi->update($validatedData);

      return to_route(
        'penilaian.seleksi.job_application_details',
        ['pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran]
      )->with('sukses', "Berhasil mengedit penilaian untuk tahapan seleksi {$tahapanSeleksi->judul_tahapan}");
    } catch (\Exception $e) {
      return to_route(
        'penilaian.seleksi.job_application_details',
        ['pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran]
      )->with('error', $e->getMessage());
    }
  }
}
