<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterData\StoreDokumenRequest;
use App\Models\Dokumen;
use App\Traits\HasMainRoute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\QueryBuilder\QueryBuilder;

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

  public function index() {
    $kodeBaru = $this->generateKodeDokumenBaru();
    $dokumen = QueryBuilder::for(Dokumen::class)
      ->allowedFilters('angkatan_tahun')
      ->get();

    return view('admin.masterdata.dokumen.index', compact('dokumen', 'kodeBaru'));
  }

  public function store(StoreDokumenRequest $request) {
    try {
      $validatedData = $request->validatedData();

      Dokumen::create($validatedData);
      Session::flash('sukses', 'Berhasil menambahkan data Jenis Dokumen');

      return back();
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }

  public function show(Dokumen $dokumen) {
    try {
      return response()->json($dokumen);
    } catch (\Exception $e) {
      return back()->with('error', 'Data jenis dokumen tidak ditemukan');
    }
  }

  public function update(StoreDokumenRequest $request, Dokumen $dokumen) {
    try {
      $validatedData = $request->validatedData();

      $dokumen->update($validatedData);
      Session::flash('sukses', 'Berhasil memperbarui data Jenis Dokumen');

      return back();
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }

  public function destroy(Dokumen $dokumen) {
    try {
      $dokumen->delete();

      return back()->with('sukses', 'Berhasil hapus data jenis dokumen');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
