<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\StoreLowonganKerjaRequest;
use App\Models\LowonganKerja;
use App\Models\MitraPerusahaan;
use App\Traits\HasMainRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ItemNotFoundException;

class LowonganKerjaController extends Controller
{
  use HasMainRoute;

  public function __construct()
  {
    $this->setMainRoute('lowongankerja.index');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $lowongan = null;
    if (Gate::check('admin')) $lowongan = LowonganKerja::all();
    else if (Gate::check('perusahaan')) $lowongan = Auth::user()->perusahaan->lowongan;
    return view('lowongankerja.index', compact('lowongan'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $perusahaan = null;
    if (Gate::check('admin')) $perusahaan = MitraPerusahaan::all();
    return view('lowongankerja.tambah', compact('perusahaan'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\AdminDanPerusahaan\StoreLowonganKerjaRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreLowonganKerjaRequest $request)
  {
    try {
      $validatedData = $request->validatedData();
      $validatedData['slug'] = Helper::generateUniqueSlug($validatedData['judul_lowongan']);

      if (Gate::check('perusahaan')) Auth::user()->perusahaan->lowongan()->create($validatedData);
      else if (Gate::check('admin')) {
        $validatedData['id_perusahaan'] = collect($request->only('id_perusahaan'))->first();
        LowonganKerja::create($validatedData);
      }
      return $this->redirectToMainRoute()->with('sukses', 'Berhasil menambahkan data Lowongan baru.');
    } catch (\Exception $e) {
      return $this->redirectToMainRoute()->with('error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  LowonganKerja $lowonganKerja
   * @return \Illuminate\Http\Response
   */
  public function show(LowonganKerja $lowonganKerja)
  {
    try {
      return view('lowongankerja.detail', compact('lowonganKerja'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  LowonganKerja $lowonganKerja
   * @return \Illuminate\Http\Response
   */
  public function edit(LowonganKerja $lowonganKerja)
  {
    try {
      $lowongan = null;
      $perusahaan = null;

      if (Gate::check('perusahaan')) {
        $lowongan = Auth::user()->perusahaan->lowongan->where('id_lowongan', $lowonganKerja->id_lowongan)->first();
      } else if (Gate::check('admin')) {
        $lowongan = $lowonganKerja;
        $perusahaan = MitraPerusahaan::all();
      }

      return view('lowongankerja.sunting', compact('lowongan', 'perusahaan'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\AdminDanPerusahaan\StoreLowonganKerjaRequest  $request
   * @param  LowonganKerja $lowonganKerja
   * @return \Illuminate\Http\Response
   */
  public function update(StoreLowonganKerjaRequest $request, LowonganKerja $lowonganKerja)
  {
    try {
      $validatedData = $request->validatedData();

      if ($validatedData['judul_lowongan'] !== $lowonganKerja->judul_lowongan) :
        $validatedData['slug'] = Helper::generateUniqueSlug($validatedData['judul_lowongan']);
      endif;

      if (Gate::check('perusahaan')) Auth::user()->perusahaan->lowongan()->where('slug', $lowonganKerja->slug)->update($validatedData);
      else if (Gate::check('admin')) {
        $validatedData['id_perusahaan'] = collect($request->only('id_perusahaan'))->first();
        $lowonganKerja->update($validatedData);
      }

      return $this->redirectToMainRoute()->with('sukses', 'Berhasil menambahkan data Lowongan baru.');
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  LowonganKerja $lowonganKerja
   * @return \Illuminate\Http\Response
   */
  public function destroy(LowonganKerja $lowonganKerja)
  {
    try {
      $deleteLowongan = $lowonganKerja->delete();
      if ($deleteLowongan) Session::flash('sukses', 'Berhasil hapus data lowongan');
      else Session::flash('error', 'Gagal menghapus data lowongan');
      return back();
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
