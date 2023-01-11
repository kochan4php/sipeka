<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Traits\HasMainRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class JurusanController extends Controller {
  use HasMainRoute;

  public function __construct() {
    $this->setMainRoute('admin.jurusan.index');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $jurusan =  QueryBuilder::for(Jurusan::class)
      ->allowedFilters('angkatan_tahun')
      ->get();

    return view('admin.masterdata.jurusan.index', compact('jurusan'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $jurusan = new Jurusan;
    $jurusan->id_jurusan = $request->input('kode_jurusan');
    $jurusan->nama_jurusan = $request->input('nama_jurusan');
    $jurusan->keterangan = $request->input('keterangan_jurusan');
    $jurusan->save();

    return redirect()->route('admin.jurusan.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    $data = collect(DB::select('SELECT * FROM jurusan WHERE id_jurusan = :kode_jurusan', [
      'kode_jurusan' => $id
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
  public function update(Request $request, $id) {
    $request->validate([
      'kode_jurusan' => ['required'],
      'nama_jurusan' => ['required'],
      'keterangan_jurusan' => ['required'],
    ]);

    $validatedData = $request->only(['kode_jurusan', 'nama_jurusan', 'keterangan_jurusan']);

    $updateOneJurusan = DB::update(
      'UPDATE jurusan SET
      nama_jurusan = :nama_jurusan,
      keterangan = :keterangan_jurusan
      WHERE id_jurusan = :kode_jurusan',
      [
        'nama_jurusan' => $validatedData['nama_jurusan'],
        'keterangan_jurusan' => $validatedData['keterangan_jurusan'],
        'kode_jurusan' => $validatedData['kode_jurusan']
      ]
    );

    if ($updateOneJurusan)
      return $this->redirectToMainRoute()->with('sukses', 'berhasil memperbarui data jurusan');
    else
      return $this->redirectToMainRoute()->with('error', 'Data tidak valid, silahkan periksa kembali');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($kodejurusan) {
    try {
      $deletejurusan = DB::delete("DELETE FROM jurusan WHERE id_jurusan = :kodejurusan", compact('kodejurusan'));
      if ($deletejurusan) return back()->with('sukses', 'Berhasil hapus jurusan');
      else return back()->with('error', 'gagal menghapus jurusan');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
