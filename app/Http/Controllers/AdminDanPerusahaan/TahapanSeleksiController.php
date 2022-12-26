<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\StoreTahapanSeleksiRequest;
use App\Models\{PendaftaranLowongan, TahapanSeleksi};

class TahapanSeleksiController extends Controller
{
  private string $tahapanSeleksiMainRoute = 'tahapan.seleksi.jobApplicationDetails';

  public function index()
  {
    $lamaranKerja = PendaftaranLowongan::with(['pelamar', 'lowongan'])->get()->load('tahapan_seleksi');
    return view('seleksi.tahapan.index', compact('lamaranKerja'));
  }

  public function create(PendaftaranLowongan $pendaftaranLowongan)
  {
    $urutanTahapanTerakhir = $pendaftaranLowongan->tahapan_seleksi()->max('urutan_tahapan_ke') + 1;
    return view('seleksi.tahapan.create', compact('pendaftaranLowongan', 'urutanTahapanTerakhir'));
  }

  public function store(StoreTahapanSeleksiRequest $request, PendaftaranLowongan $pendaftaranLowongan)
  {
    try {
      $validatedData = $request->validatedData();
      $pendaftaranLowongan->tahapan_seleksi()->create($validatedData);
      $namaPelamar = $pendaftaranLowongan->pelamar->alumni ?
        $pendaftaranLowongan->pelamar->alumni->nama_lengkap :
        $pendaftaranLowongan->pelamar->masyarakat->nama_lengkap;

      $successMsg = "Berhasil menambahkan tahapan seleksi baru dari pelamar {$namaPelamar}";
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $pendaftaranLowongan->id_pendaftaran
      )->with('sukses', $successMsg);
    } catch (\Exception $e) {
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $pendaftaranLowongan->id_pendaftaran
      )->with('error', $e->getMessage());
    }
  }

  public function jobApplicationDetails(PendaftaranLowongan $pendaftaranLowongan)
  {
    return view('seleksi.tahapan.job_application_details', compact('pendaftaranLowongan'));
  }

  public function edit(PendaftaranLowongan $pendaftaranLowongan, TahapanSeleksi $tahapanSeleksi)
  {
    return view('seleksi.tahapan.edit', compact('pendaftaranLowongan', 'tahapanSeleksi'));
  }

  public function update(StoreTahapanSeleksiRequest $request, PendaftaranLowongan $pendaftaranLowongan, TahapanSeleksi $tahapanSeleksi)
  {
    try {
      $validatedData = $request->validatedData();
      $pendaftaranLowongan->tahapan_seleksi()->firstWhere('id_tahapan', $tahapanSeleksi->id_tahapan)->update($validatedData);
      $namaPelamar = $pendaftaranLowongan->pelamar->alumni ?
        $pendaftaranLowongan->pelamar->alumni->nama_lengkap :
        $pendaftaranLowongan->pelamar->masyarakat->nama_lengkap;

      $successMsg = "Berhasil memperbarui tahapan seleksi baru dari pelamar {$namaPelamar}";
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $pendaftaranLowongan->id_pendaftaran
      )->with('sukses', $successMsg);
    } catch (\Exception $e) {
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $pendaftaranLowongan->id_pendaftaran
      )->with('error', $e->getMessage());
    }
  }

  public function destroy(PendaftaranLowongan $pendaftaranLowongan, TahapanSeleksi $tahapanSeleksi)
  {
    try {
      $pendaftaranLowongan->tahapan_seleksi()->firstWhere('id_tahapan', $tahapanSeleksi->id_tahapan)->delete();

      $namaPelamar = $pendaftaranLowongan->pelamar->alumni ?
        $pendaftaranLowongan->pelamar->alumni->nama_lengkap :
        $pendaftaranLowongan->pelamar->masyarakat->nama_lengkap;

      $successMsg = "Berhasil menghapus tahapan seleksi untuk pelamar {$namaPelamar}";
      return back()->with('sukses', $successMsg);
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
