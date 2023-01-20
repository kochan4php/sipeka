<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\StoreLowonganKerjaRequest;
use App\Models\{LowonganKerja, MitraPerusahaan};
use App\Traits\HasMainRoute;
use Illuminate\Support\Facades\{Auth, Gate};
use Illuminate\Support\ItemNotFoundException;
use Spatie\QueryBuilder\QueryBuilder;

class LowonganKerjaController extends Controller {
  use HasMainRoute;

  public function __construct() {
    $this->setMainRoute('lowongankerja.index');
  }

  public function index() {
    $lowongan = null;

    if (Gate::check('admin')) {
      $lowongan = QueryBuilder::for(LowonganKerja::class)
        ->allowedFilters('angkatan_tahun')
        ->get();
    } else if (Gate::check('perusahaan')) {
      $lowongan = Auth::user()->perusahaan->lowongan;
    }

    return view('lowongankerja.index', compact('lowongan'));
  }

  public function create() {
    $perusahaan = null;

    if (Gate::check('admin')) {
      $perusahaan = MitraPerusahaan::all();
    }

    return view('lowongankerja.tambah', compact('perusahaan'));
  }

  public function store(StoreLowonganKerjaRequest $request) {
    try {
      $validatedData = $request->validatedData();
      $validatedData['slug'] = Helper::generateUniqueSlug($validatedData['judul_lowongan']);

      if (Gate::check('perusahaan')) {
        Auth::user()->perusahaan->lowongan()->create($validatedData);
      } else if (Gate::check('admin')) {
        $validatedData['id_perusahaan'] = collect($request->only('id_perusahaan'))->first();
        LowonganKerja::create($validatedData);
      }

      return $this->redirectToMainRoute()->with('sukses', 'Berhasil menambahkan data Lowongan baru.');
    } catch (\Exception $e) {
      return $this->redirectToMainRoute()->with('error', $e->getMessage());
    }
  }

  public function show(LowonganKerja $lowonganKerja) {
    try {
      return view('lowongankerja.detail', compact('lowonganKerja'));
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }

  public function edit(LowonganKerja $lowonganKerja) {
    try {
      $lowongan = null;
      $perusahaan = null;

      if (Gate::check('perusahaan')) {
        $lowongan = Auth::user()->perusahaan->lowongan->firstWhere('id_lowongan', $lowonganKerja->id_lowongan);
      } else if (Gate::check('admin')) {
        $lowongan = $lowonganKerja;
        $perusahaan = MitraPerusahaan::all();
      }

      return view('lowongankerja.sunting', compact('lowongan', 'perusahaan'));
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }

  public function update(StoreLowonganKerjaRequest $request, LowonganKerja $lowonganKerja) {
    try {
      $validatedData = $request->validatedData();

      if ($validatedData['judul_lowongan'] !== $lowonganKerja->judul_lowongan) {
        $validatedData['slug'] = Helper::generateUniqueSlug($validatedData['judul_lowongan']);
      }

      if (Gate::check('perusahaan')) {
        Auth::user()->perusahaan->lowongan()->firstWhere('slug', $lowonganKerja->slug)->update($validatedData);
      } else if (Gate::check('admin')) {
        $validatedData['id_perusahaan'] = collect($request->only('id_perusahaan'))->first();
        $lowonganKerja->update($validatedData);
      }

      return $this->redirectToMainRoute()->with('sukses', 'Berhasil menambahkan data Lowongan baru.');
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }

  public function destroy(LowonganKerja $lowonganKerja) {
    try {
      $lowonganKerja->delete();

      return back()->with('sukses', 'Berhasil hapus data lowongan');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
