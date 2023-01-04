<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterData\StoreDokumenRequest;
use App\Models\Dokumen;
use App\Traits\HasMainRoute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DokumenController extends Controller {
  use HasMainRoute;

  public function __construct() {
    $this->setMainRoute('admin.dokumen.index');
  }

  private function generateKodeDokumenBaru(): string {
    return collect(DB::select('SELECT generate_new_kode_jenis_dokumen() AS new_kode_jenis_dokumen'))
      ->firstOrFail()
      ->new_kode_jenis_dokumen;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $dokumen = Dokumen::all();
    $kodeBaru = $this->generateKodeDokumenBaru();
    return view('admin.masterdata.dokumen.index', compact('dokumen', 'kodeBaru'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreDokumenRequest $request) {
    try {
      $validatedData = $request->validatedData();
      if (Dokumen::create($validatedData)) return Session::flash('sukses', 'Berhasil menambahkan data Jenis Dokumen');
      else return Session::flash('error', 'Data tidak valid, silahkan periksa kembali');
      return back();
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  Dokumen  $dokumen
   * @return \Illuminate\Http\Response
   */
  public function show(Dokumen $dokumen) {
    try {
      return response()->json($dokumen);
    } catch (\Exception $e) {
      return back()->with('error', 'Data jenis dokumen tidak ditemukan');
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  Dokumen  $dokumen
   * @return \Illuminate\Http\Response
   */
  public function update(StoreDokumenRequest $request, Dokumen $dokumen) {
    try {
      $validatedData = $request->validatedData();
      if ($dokumen->update($validatedData)) Session::flash('sukses', 'Berhasil memperbarui data Jenis Dokumen');
      else Session::flash('error', 'Data tidak valid, silahkan periksa kembali');
      return back();
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Dokumen  $dokumen
   * @return \Illuminate\Http\Response
   */
  public function destroy(Dokumen $dokumen) {
    try {
      if ($dokumen->delete()) return back()->with('sukses', 'Berhasil hapus data jenis dokumen');
      else return back()->with('error', 'Gagal menghapus data jenis dokumen');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
