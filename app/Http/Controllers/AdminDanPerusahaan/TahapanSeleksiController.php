<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\StoreTahapanSeleksiRequest;
use App\Models\{LowonganKerja, TahapanSeleksi};
use Illuminate\Support\Facades\{Auth, Gate};

class TahapanSeleksiController extends Controller
{
  private string $tahapanSeleksiMainRoute = 'tahapan.seleksi.index';

  public function index()
  {
    $lowongan = null;
    if (Gate::check('admin')) $lowongan = LowonganKerja::all()->load('tahapan_seleksi');
    else if (Gate::check('perusahaan')) $lowongan = Auth::user()->perusahaan->lowongan->load('tahapan_seleksi');
    return view('seleksi.tahapan.index', compact('lowongan'));
  }

  public function create(LowonganKerja $lowonganKerja)
  {
    $urutanTahapanTerakhir = $lowonganKerja->tahapan_seleksi()->max('urutan_tahapan_ke') + 1;
    return view('seleksi.tahapan.create', compact('lowonganKerja', 'urutanTahapanTerakhir'));
  }

  public function store(StoreTahapanSeleksiRequest $request, LowonganKerja $lowonganKerja)
  {
    try {
      $validatedData = $request->validatedData();
      $insertOneStage = $lowonganKerja->tahapan_seleksi()->create($validatedData);
      $successMsg = "Berhasil menambahkan tahapan seleksi baru untuk lowongan {$lowonganKerja->judul_lowongan}";

      if (Gate::check('admin')) :
        $successMsg .=  " dari perusahaan {$lowonganKerja->perusahaan->nama_perusahaan}";
      endif;

      if ($insertOneStage) return to_route($this->tahapanSeleksiMainRoute)->with('sukses', $successMsg);
      else return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (\Exception $e) {
      return to_route($this->tahapanSeleksiMainRoute)->with('error', $e->getMessage());
    }
  }

  public function edit(LowonganKerja $lowonganKerja, TahapanSeleksi $tahapanSeleksi)
  {
    return view('seleksi.tahapan.edit', compact('lowonganKerja', 'tahapanSeleksi'));
  }

  public function update(StoreTahapanSeleksiRequest $request, LowonganKerja $lowonganKerja, TahapanSeleksi $tahapanSeleksi)
  {
    try {
      $validatedData = $request->validatedData();
      $updateOneStage = $lowonganKerja->tahapan_seleksi()->firstWhere('id_tahapan', $tahapanSeleksi->id_tahapan)->update($validatedData);
      $successMsg = "Berhasil memperbarui tahapan seleksi untuk lowongan {$lowonganKerja->judul_lowongan}";

      if (Gate::check('admin')) :
        $successMsg .=  " dari perusahaan {$lowonganKerja->perusahaan->nama_perusahaan}";
      endif;

      if ($updateOneStage) return to_route($this->tahapanSeleksiMainRoute)->with('sukses', $successMsg);
      else return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (\Exception $e) {
      return to_route($this->tahapanSeleksiMainRoute)->with('error', $e->getMessage());
    }
  }

  public function destroy(LowonganKerja $lowonganKerja, TahapanSeleksi $tahapanSeleksi)
  {
    try {
      $lowonganKerja->tahapan_seleksi()->firstWhere('id_tahapan', $tahapanSeleksi->id_tahapan)->delete();
      $successMsg = "Berhasil menghapus tahapan seleksi untuk lowongan {$lowonganKerja->judul_lowongan}";
      return back()->with('sukses', $successMsg);
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
