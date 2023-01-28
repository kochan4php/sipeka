<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\StoreLowonganKerjaRequest;
use App\Models\{JenisPekerjaan, LowonganKerja, MitraPerusahaan, PendaftaranLowongan};
use App\Traits\HasMainRoute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{Auth, Gate};
use Illuminate\Support\ItemNotFoundException;
use Spatie\QueryBuilder\QueryBuilder;

final class LowonganKerjaController extends Controller {
  use HasMainRoute;

  public function __construct() {
    $this->setMainRoute('lowongankerja.index');
  }

  public function index(): View {
    $lowongan = null;

    if (Gate::check('admin')) {
      $lowongan = QueryBuilder::for(LowonganKerja::class)
        ->allowedFilters('angkatan_tahun')
        ->with('perusahaan')
        ->get();
      $pendaftaranLowongan = PendaftaranLowongan::count();
    } else if (Gate::check('perusahaan')) {
      $lowongan = Auth::user()->perusahaan->lowongan;
    }

    return view('lowongankerja.index', compact('lowongan', 'pendaftaranLowongan'));
  }

  public function create(): View {
    $perusahaan = null;
    $jenisPekerjaan = JenisPekerjaan::all();

    if (Gate::check('admin')) {
      $perusahaan = MitraPerusahaan::all();
    }

    return view('lowongankerja.tambah', compact('perusahaan', 'jenisPekerjaan'));
  }

  public function store(StoreLowonganKerjaRequest $request): RedirectResponse {
    try {
      $validatedData = $request->validatedData();
      $validatedData['slug'] = Helper::generateUniqueSlug($validatedData['judul_lowongan']);

      if (Gate::check('perusahaan')) {
        Auth::user()->perusahaan->lowongan()->create($validatedData);
      } else if (Gate::check('admin')) {
        $validatedData['id_perusahaan'] = collect($request->only('id_perusahaan'))->first();
        $validatedData['is_approve'] = true;

        LowonganKerja::create($validatedData);
      }

      notify()->success('Berhasil menambahkan data Lowongan baru.', 'Notifikasi');

      return $this->redirectToMainRoute();
    } catch (\Exception $e) {
      notify()->error($e->getMessage(), 'Notifikasi');

      return $this->redirectToMainRoute();
    }
  }

  public function show(LowonganKerja $lowonganKerja): View|RedirectResponse {
    try {
      return view('lowongankerja.detail', compact('lowonganKerja'));
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }

  public function edit(LowonganKerja $lowonganKerja): View|RedirectResponse {
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

  public function update(StoreLowonganKerjaRequest $request, LowonganKerja $lowonganKerja): RedirectResponse {
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

  public function nonActive(LowonganKerja $lowonganKerja): RedirectResponse {
    try {
      $lowonganKerja->update(['active' => false]);
      notify()->success('Berhasil menonaktifkan lowongan', 'Notifikasi');
      return back();
    } catch (\Exception $e) {
      notify()->success($e->getMessage(), 'Notifikasi');
      return back();
    }
  }
}
