<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\StoreTahapanSeleksiRequest;
use App\Models\LowonganKerja;
use App\Models\TahapanSeleksi;

class SeleksiController extends Controller
{
  private string $tahapanSeleksiMainRoute = 'tahapan.seleksi.index';

  public function indexStages()
  {
    $lowongan = LowonganKerja::all()->load('tahapan_seleksi');
    return view('seleksi.tahapan.index', compact('lowongan'));
  }

  public function addStages(LowonganKerja $lowonganKerja)
  {
    $urutanTahapanTerakhir = $lowonganKerja->tahapan_seleksi()->max('urutan_tahapan_ke') + 1;
    return view('seleksi.tahapan.create', compact('lowonganKerja', 'urutanTahapanTerakhir'));
  }

  public function storeAddStages(StoreTahapanSeleksiRequest $request, LowonganKerja $lowonganKerja)
  {
    try {
      $judulLowongan = $lowonganKerja->judul_lowongan;
      $namaPerusahaan = $lowonganKerja->perusahaan->nama_perusahaan;

      $validatedData = $request->validatedData();
      $validatedData['slug'] = Helper::generateUniqueSlug($validatedData['judul_tahapan']);
      $insertOneStage = $lowonganKerja->tahapan_seleksi()->create($validatedData);
      $successMessage =
        'Berhasil menambahkan tahapan seleksi baru untuk lowongan ' . $judulLowongan . ' dari perusahaan ' . $namaPerusahaan;

      if ($insertOneStage) return to_route($this->tahapanSeleksiMainRoute)->with('sukses', $successMessage);
      else return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (\Exception $e) {
      return to_route($this->tahapanSeleksiMainRoute)->with('error', $e->getMessage());
    }
  }

  public function editStages(LowonganKerja $lowonganKerja, TahapanSeleksi $tahapanSeleksi)
  {
    return view('seleksi.tahapan.edit', compact('lowonganKerja', 'tahapanSeleksi'));
  }

  public function storeUpdateStages(StoreTahapanSeleksiRequest $request, LowonganKerja $lowonganKerja, TahapanSeleksi $tahapanSeleksi)
  {
    try {
      $judulLowongan = $lowonganKerja->judul_lowongan;
      $namaPerusahaan = $lowonganKerja->perusahaan->nama_perusahaan;

      $validatedData = $request->validatedData();

      if ($validatedData['judul_tahapan'] !== $tahapanSeleksi->judul_tahapan) :
        $validatedData['slug'] = Helper::generateUniqueSlug($validatedData['judul_tahapan']);
      endif;

      $updateOneStage = $lowonganKerja->tahapan_seleksi()->where('slug', $tahapanSeleksi->slug)->update($validatedData);
      $successMessage =
        'Berhasil memperbarui tahapan seleksi untuk lowongan ' . $judulLowongan . ' dari perusahaan ' . $namaPerusahaan;

      if ($updateOneStage) return to_route($this->tahapanSeleksiMainRoute)->with('sukses', $successMessage);
      else return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (\Exception $e) {
      return to_route($this->tahapanSeleksiMainRoute)->with('error', $e->getMessage());
    }
  }

  public function destroyStages(LowonganKerja $lowonganKerja, TahapanSeleksi $tahapanSeleksi)
  {
    $lowonganKerja->tahapan_seleksi()->where('slug', $tahapanSeleksi->slug)->delete();
    return to_route($this->tahapanSeleksiMainRoute)->with('sukses', 'Berhasil menghapus data tahapan seleksi');
  }
}
