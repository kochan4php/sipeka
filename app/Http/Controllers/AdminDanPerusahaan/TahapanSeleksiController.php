<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\Tahapan\StoreTahapanSeleksiRequest;
use App\Models\{LowonganKerja, TahapanSeleksi};
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{Auth, Gate};

final class TahapanSeleksiController extends Controller {
  private string $tahapanSeleksiMainRoute = 'tahapan.seleksi.detail_lowongan';

  public function create(LowonganKerja $lowonganKerja): View {
    $urutanTahapanTerakhir = $lowonganKerja->tahapan_seleksi()->max('urutan_tahapan_ke') + 1;

    return view('seleksi.tahapan.create', compact('lowonganKerja', 'urutanTahapanTerakhir'));
  }

  public function store(StoreTahapanSeleksiRequest $request, LowonganKerja $lowonganKerja): RedirectResponse {
    try {
      $validatedData = $request->validatedData();
      $lowonganKerja->tahapan_seleksi()->create($validatedData);
      $successMessage = "Berhasil menambahkan tahapan seleksi baru untuk lowongan {$lowonganKerja->judul_lowongan}";

      if (Gate::check('admin')) {
        $successMessage .=  " dari perusahaan {$lowonganKerja->perusahaan->nama_perusahaan}";
      }

      return to_route(
        $this->tahapanSeleksiMainRoute,
        $lowonganKerja->slug
      )->with('sukses', $successMessage);
    } catch (\Exception $e) {
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $lowonganKerja->slug
      )->with('error', $e->getMessage());
    }
  }

  public function jobDetail(LowonganKerja $lowonganKerja): View {
    return view('seleksi.tahapan.job_detail', compact('lowonganKerja'));
  }

  public function edit(LowonganKerja $lowonganKerja, TahapanSeleksi $tahapanSeleksi): View {
    return view('seleksi.tahapan.edit', compact('lowonganKerja', 'tahapanSeleksi'));
  }

  public function update(
    StoreTahapanSeleksiRequest $request,
    LowonganKerja $lowonganKerja,
    TahapanSeleksi $tahapanSeleksi
  ): RedirectResponse {
    try {
      $validatedData = $request->validatedData();
      $existsUrutanTahapan = $lowonganKerja
        ->tahapan_seleksi
        ->firstWhere('urutan_tahapan_ke', $validatedData['urutan_tahapan_ke']);

      if (!is_null($existsUrutanTahapan?->urutan_tahapan_ke) && $existsUrutanTahapan?->id_tahapan !== $tahapanSeleksi->id_tahapan) {
        if ((int) $validatedData['urutan_tahapan_ke'] === $existsUrutanTahapan->urutan_tahapan_ke) {
          return back()->with('error', "Urutan tahapan ke-{$existsUrutanTahapan->urutan_tahapan_ke} sudah ada.");
        };
      }

      $lowonganKerja->tahapan_seleksi()->firstWhere('id_tahapan', $tahapanSeleksi->id_tahapan)->update($validatedData);
      $successMessage = "Berhasil memperbarui tahapan seleksi untuk lowongan {$lowonganKerja->judul_lowongan}";

      if (Gate::check('admin')) {
        $successMessage .=  " dari perusahaan {$lowonganKerja->perusahaan->nama_perusahaan}";
      }

      return to_route(
        $this->tahapanSeleksiMainRoute,
        $lowonganKerja->slug
      )->with('sukses', $successMessage);
    } catch (\Exception $e) {
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $lowonganKerja->slug
      )->with('error', $e->getMessage());
    }
  }

  public function destroy(LowonganKerja $lowonganKerja, TahapanSeleksi $tahapanSeleksi): RedirectResponse {
    $lowonganKerja->tahapan_seleksi()->firstWhere('id_tahapan', $tahapanSeleksi->id_tahapan)->delete();
    $successMessage = "Berhasil menghapus tahapan seleksi untuk lowongan {$lowonganKerja->judul_lowongan}";

    return to_route(
      $this->tahapanSeleksiMainRoute,
      $lowonganKerja->slug
    )->with('sukses', $successMessage);
  }
}
