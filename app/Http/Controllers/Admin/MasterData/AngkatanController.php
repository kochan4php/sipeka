<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\QueryBuilder\QueryBuilder;

final class AngkatanController extends Controller {
  public function index() {
    $angkatan = QueryBuilder::for(Angkatan::class)
      ->allowedFilters('angkatan_tahun')
      ->get();

    return view('admin.masterdata.angkatan.index', compact('angkatan'));
  }

  public function store(Request $request) {
    try {
      $request->validate(['id_angkatan' => ['required'], 'angkatan_tahun' => ['required']]);
      $validatedData = $request->only(['id_angkatan', 'angkatan_tahun']);

      Angkatan::create($validatedData);
      Session::flash('sukses', 'Berhasil menambahkan data Angkatan Baru');

      return back();
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }

  public function show(Angkatan $angkatan) {
    try {
      return response()->json($angkatan);
    } catch (\Exception $e) {
      return back()->with('error', 'Data jenis dokumen tidak ditemukan');
    }
  }

  public function update(Request $request, Angkatan $angkatan) {
    try {
      $request->validate(['id_angkatan' => ['required'], 'angkatan_tahun' => ['required']]);
      $validatedData = $request->only(['id_angkatan', 'angkatan_tahun']);

      $angkatan->update($validatedData);
      Session::flash('sukses', 'berhasil memperbarui data angkatan');

      return back();
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
