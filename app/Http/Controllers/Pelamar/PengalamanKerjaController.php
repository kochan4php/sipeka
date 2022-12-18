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
    return to_route('pelamar.experience.index', Auth::user()->username);
  }

  public function edit(string $username, int $id)
  {
    $jenisPekerjaan = $this->jenisPekerjaan;
    $pengalamanKerja = Auth::user()->pelamar->pengalaman_bekerja->firstWhere('id_pengalaman', $id);
    return view('pelamar.experience.sunting', compact('pengalamanKerja', 'jenisPekerjaan'));
  }

  public function update(Request $request, string $username, int $id)
  {
    $validatedData = $request->only([
      "judul_posisi",
      "nama_perusahaan",
      "id_jenis_pekerjaan",
      "tanggal_masuk",
      "tanggal_selesai",
      "deskripsi_pengalaman"
    ]);

    Auth::user()->pelamar->pengalaman_bekerja()->firstWhere('id_pengalaman', $id)->update($validatedData);
    return to_route('pelamar.experience.index', $username)->with('sukses', 'berhasil memperbarui data pengalaman');
  }

  public function destroy(string $username, int $id)
  {
    try {
      $pengalamanKerja = Auth::user()->pelamar->pengalaman_bekerja()->firstWhere('id_pengalaman', $id)->delete();
      if ($pengalamanKerja) return back()->with('sukses', 'Berhasil di hapus ');
      else return redirect()->back()->with('error', 'Gagal menghapus');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
