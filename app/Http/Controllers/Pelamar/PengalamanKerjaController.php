<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\JenisPekerjaan;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class PengalamanKerjaController extends Controller {
  private Collection $jenisPekerjaan;

  public function __construct() {
    $this->jenisPekerjaan = JenisPekerjaan::all();
  }

  public function index(): View {
    $pengalamanKerja = Auth::user()->pelamar->pengalaman_bekerja;

    return view('pelamar.experience.index', compact('pengalamanKerja'));
  }

  public function create(): View {
    $jenisPekerjaan = $this->jenisPekerjaan;

    return view('pelamar.experience.tambah', compact('jenisPekerjaan'));
  }

  public function store(Request $request, string $username): RedirectResponse {
    $validatedData = $request->only([
      "judul_posisi",
      "nama_perusahaan",
      "id_jenis_pekerjaan",
      "tanggal_masuk",
      "tanggal_selesai",
      "deskripsi_pengalaman"
    ]);

    Auth::user()->pelamar->pengalaman_bekerja()->create($validatedData);
    return to_route('pelamar.experience.index', $username);
  }

  public function edit(string $username, int $id): View {
    $jenisPekerjaan = $this->jenisPekerjaan;
    $pengalamanKerja = Auth::user()->pelamar->pengalaman_bekerja->firstWhere('id_pengalaman', $id);

    return view('pelamar.experience.sunting', compact('pengalamanKerja', 'jenisPekerjaan'));
  }

  public function update(Request $request, string $username, int $id): RedirectResponse {
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

  public function destroy(string $username, int $id): RedirectResponse {
    try {
      $pengalamanKerja = Auth::user()->pelamar->pengalaman_bekerja()->firstWhere('id_pengalaman', $id)->delete();

      return back()->with('sukses', 'Berhasil di hapus ');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
