<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\JenisPekerjaan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengalamanKerjaController extends Controller
{
  private Collection $jenisPekerjaan;

  public function __construct()
  {
    $this->jenisPekerjaan = JenisPekerjaan::all();
  }

  public function index()
  {
    $pengalamanKerja = Auth::user()->pelamar->pengalaman_bekerja;
    return view('pelamar.experience.index', compact('pengalamanKerja'));
  }

  public function create()
  {
    $jenisPekerjaan = $this->jenisPekerjaan;
    return view('pelamar.experience.tambah', compact('jenisPekerjaan'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->only([
      "judul_posisi",
      "nama_perusahaan",
      "id_jenis_pekerjaan",
      "tanggal_masuk",
      "tanggal_selesai",
      "deskripsi_pengalaman"
    ]);

    Auth::user()->pelamar->pengalaman_bekerja()->create($validatedData);
    return redirect()->route('pelamar.experience.index',);
  }

  public function edit($id)
  {
    // $pengalamanKerja = PengalamanKerja::where('id_pengalaman', $id)->first();
    $jenisPekerjaan = $this->jenisPekerjaan;
    $pengalamanKerja = Auth::user()->pelamar->pengalaman_bekerja->where('id_pengalaman', $id)->first();
    return view('pelamar.experience.sunting', compact('pengalamanKerja', 'jenisPekerjaan'));
  }

  public function update(Request $request, $id)
  {
    $validatedData = $request->only([
      "judul_posisi",
      "nama_perusahaan",
      "id_jenis_pekerjaan",
      "tanggal_masuk",
      "tanggal_selesai",
      "deskripsi_pengalaman"
    ]);

    // PengalamanKerja::where('id_pengalaman', $id)->update($validatedData);
    Auth::user()->pelamar->pengalaman_bekerja()->where('id_pengalaman', $id)->update($validatedData);
    return redirect()->route('pelamar.experience.index')->with('sukses', 'berhasil memperbarui data pengalaman');
  }

  public function destroy($id)
  {
    try {
      if ($pengalamanKerja->delete()) return back()->with('sukses', 'Berhasil di hapus ');
      else return redirect()->back()->with('error', 'Gagal menghapus');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
