<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\Tahapan\StorePenilaianSeleksiRequest;
use App\Models\Dokumen;
use App\Models\PendaftaranLowongan;
use App\Models\PenilaianSeleksi;
use App\Models\TahapanSeleksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class PenilaianSeleksiController extends Controller {
  private function getIdPendaftaran(PendaftaranLowongan $pendaftaranLowongan): string {
    return $pendaftaranLowongan->id_pendaftaran;
  }

  public function index() {
    $pendaftaranLowongan = null;
    $jenisDokumen = Dokumen::all();

    if (Gate::check('admin')) {
      $pendaftaranLowongan = QueryBuilder::for(PendaftaranLowongan::class)
        ->allowedFilters(['kode_pendaftaran', 'verifikasi', 'status_seleksi'])
        ->latest()
        ->get();
    } else if (Gate::check('perusahaan')) {
      $pendaftaranLowongan = Auth::user()->perusahaan->pendaftaran_lowongan;
    }

    return view('seleksi.penilaian.index', compact('pendaftaranLowongan', 'jenisDokumen'));
  }

  public function jobApplicationDetails(PendaftaranLowongan $pendaftaranLowongan) {
    $dataPelamar = UserHelper::getApplicantData($pendaftaranLowongan->pelamar);
    $namaPelamar = $dataPelamar->nama_lengkap;

    return view('seleksi.penilaian.job_application_details', compact('pendaftaranLowongan', 'namaPelamar', 'dataPelamar'));
  }

  public function passApplicants(PendaftaranLowongan $pendaftaranLowongan) {
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

      $pendaftaran_lowongan = $this->getIdPendaftaran($pendaftaranLowongan);

      return to_route('penilaian.seleksi.job_application_details', compact('pendaftaran_lowongan'))
        ->with('sukses', "Berhasil mengedit penilaian untuk tahapan seleksi {$tahapanSeleksi->judul_tahapan}");
    } catch (\Exception $e) {
      return to_route('penilaian.seleksi.job_application_details', compact('pendaftaran_lowongan'))
        ->with('error', $e->getMessage());
    }
  }
}
