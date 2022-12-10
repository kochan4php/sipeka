<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AngkatanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $angkatan = Angkatan::all();
    return view('admin.masterdata.angkatan.index', compact('angkatan'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $angkatan = new Angkatan;
    $angkatan->id_angkatan = $request->input('id_angkatan');
    $angkatan->angkatan_tahun = $request->input('tahun_angkatan');
    $angkatan->save();

    return redirect()->route('admin.angkatan.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Angkatan $angkatan)
  {
    return response()->json($angkatan);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Angkatan $angkatan)
  {
    $request->validate([
      'id_angkatan' => ['required'],
      'angkatan_tahun' => ['required'],
    ]);

    $validatedData = $request->only(['id_angkatan', 'angkatan_tahun']);
    if ($angkatan->update($validatedData))
      return back()->with('sukses', 'berhasil memperbarui data angkatan');
    else
      return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Angkatan $angkatan)
  {
    try {
      if ($angkatan->delete()) return back()->with('sukses', 'Berhasil hapus angkatan');
      else return back()->with('error', 'gagal menghapus angkatan');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    };
  }
}
