<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\QueryBuilder\QueryBuilder;

class AngkatanController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $angkatan = QueryBuilder::for(Angkatan::class)
      ->allowedFilters('angkatan_tahun')
      ->get();

    return view('admin.masterdata.angkatan.index', compact('angkatan'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    try {
      $request->validate(['id_angkatan' => ['required'], 'angkatan_tahun' => ['required']]);
      $validatedData = $request->only(['id_angkatan', 'angkatan_tahun']);
      if (Angkatan::create($validatedData)) return Session::flash('sukses', 'Berhasil menambahkan data Angkatan Baru');
      else return Session::flash('error', 'Data tidak valid, silahkan periksa kembali');
      return back();
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  Angkatan  $angkatan
   * @return \Illuminate\Http\Response
   */
  public function show(Angkatan $angkatan) {
    try {
      return response()->json($angkatan);
    } catch (\Exception $e) {
      return back()->with('error', 'Data jenis dokumen tidak ditemukan');
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  Angkatan  $angkatan
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Angkatan $angkatan) {
    try {
      $request->validate(['id_angkatan' => ['required'], 'angkatan_tahun' => ['required']]);
      $validatedData = $request->only(['id_angkatan', 'angkatan_tahun']);
      if ($angkatan->update($validatedData)) Session::flash('sukses', 'berhasil memperbarui data angkatan');
      else Session::flash('error', 'Data tidak valid, silahkan periksa kembali');
      return back();
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Angkatan  $angkatan
   * @return \Illuminate\Http\Response
   */
  public function destroy(Angkatan $angkatan) {
    try {
      if ($angkatan->delete()) return back()->with('sukses', 'Berhasil hapus angkatan');
      else return back()->with('error', 'gagal menghapus angkatan');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    };
  }
}
