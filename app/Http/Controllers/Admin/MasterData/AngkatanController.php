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
    // $angkatan = DB::table('angkatan')->paginate(10);
    $angkatan = collect(DB::select('SELECT * FROM angkatan'));
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
    $angkatan->id_angkatan = $request->input('kode_angkatan');
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
  public function show($id)
  {
    $data = collect(DB::select('SELECT * FROM angkatan WHERE id_angkatan = :kode_angkatan', [
      'kode_angkatan' => $id
    ]))->first();

    return response()->json($data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'kode_angkatan' => ['required'],
      'angkatan_tahun' => ['required'],
    ]);

    $validatedData = $request->only(['kode_angkatan', 'angkatan_tahun']);

    $updateOneAngkatan = DB::update(
      'UPDATE angkatan SET
      angkatan_tahun = :tahun_angkatan
      WHERE id_angkatan = :kode_angkatan',
      [
        'kode_angkatan' => $validatedData['kode_angkatan'],
        'angkatan_tahun' => $validatedData['angkatan_tahun']
      ]
    );

    if ($updateOneAngkatan)
      return $this->redirectToMainRoute()->with('sukses', 'berhasil memperbarui data angkatan');
    else
      return $this->redirectToMainRoute()->with('error', 'Data tidak valid, silahkan periksa kembali');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($kodejurusan)
  {
    try {
      $deleteangkatan = DB::delete("DELETE FROM angkatan WHERE id_angkatan = :kodeangkatan", compact('kodeangkatan'));
      if ($deleteangkatan) return back()->with('sukses', 'Berhasil hapus angkatan');
      else return back()->with('error', 'gagal menghapus angkatan');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    };
  }
}
