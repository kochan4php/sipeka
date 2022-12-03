<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterData\StoreDokumenRequest;
use App\Traits\HasMainRoute;
use Illuminate\Support\Facades\DB;

class DokumenController extends Controller
{
  use HasMainRoute;

  public function __construct()
  {
    $this->setMainRoute('admin.dokumen.index');
  }

  private function generateKodeDokumenBaru(): string
  {
    return collect(DB::select('SELECT generate_new_kode_jenis_dokumen() AS new_kode_jenis_dokumen'))
      ->firstOrFail()
      ->new_kode_jenis_dokumen;
  }

  private function getOneJenisDokumen(string $kodeDokumen)
  {
    return collect(DB::select("SELECT * FROM dokumen WHERE id_jenis_dokumen = :kodeDokumen", compact('kodeDokumen')))
      ->firstOrFail();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $dokumen = collect(DB::select("SELECT * FROM dokumen"));
    $kodeBaru = $this->generateKodeDokumenBaru();
    return view('admin.masterdata.dokumen.index', compact('dokumen', 'kodeBaru'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreDokumenRequest $request)
  {
    try {
      $validatedData = $request->validatedDokumenAttr();
      $insertOneDokumen = DB::insert(
        "INSERT INTO dokumen (id_jenis_dokumen, nama_dokumen)
          VALUES (:id_jenis_dokumen, :nama_dokumen)",
        [
          'id_jenis_dokumen' => $validatedData['kode_jenis_dokumen'],
          'nama_dokumen' => $validatedData['nama_dokumen']
        ]
      );

      if ($insertOneDokumen)
        return $this->redirectToMainRoute()->with('sukses', 'Berhasil menambahkan data Jenis Dokumen');
      else
        return redirect()->back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (\Exception $e) {
      return $this->redirectToMainRoute()->with('error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  string  $kodeDokumen
   * @return \Illuminate\Http\Response
   */
  public function show(string $kodeDokumen)
  {
    try {
      return response()->json($this->getOneJenisDokumen($kodeDokumen));
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Data jenis dokumen tidak ditemukan');
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $kodeDokumen
   * @return \Illuminate\Http\Response
   */
  public function update(StoreDokumenRequest $request, string $kodeDokumen)
  {
    $validatedData = $request->validatedDokumenAttr();
    $updateOneJenisDokumen = DB::update(
      "UPDATE dokumen SET nama_dokumen = :nama_dokumen WHERE id_jenis_dokumen = :kode_jenis_dokumen",
      [
        'nama_dokumen' => $validatedData['nama_dokumen'],
        'kode_jenis_dokumen' => $validatedData['kode_jenis_dokumen'] ?? $kodeDokumen
      ]
    );
    if ($updateOneJenisDokumen)
      return $this->redirectToMainRoute()->with('sukses', 'Berhasil memperbarui data Jenis Dokumen');
    else
      return redirect()->back()->with('error', 'Data tidak valid, silahkan periksa kembali');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  string  $kodeDokumen
   * @return \Illuminate\Http\Response
   */
  public function destroy(string $kodeDokumen)
  {
    try {
      $deleteDokumen = DB::delete("DELETE FROM dokumen WHERE id_jenis_dokumen = :kodeDokumen", compact('kodeDokumen'));
      if ($deleteDokumen) return redirect()->back()->with('sukses', 'Berhasil hapus data jenis dokumen');
      else return redirect()->back()->with('error', 'Gagal menghapus data jenis dokumen');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
