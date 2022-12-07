<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\LowonganKerja;
use App\Models\MitraPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LowonganController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // $angkatan = DB::table('angkatan')->paginate(10);
    $lowongan = DB::table('lowongan_kerja')->select()->get();
    return view('perusahaan.index', ['lowongan' => $lowongan]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('perusahaan.lowongankerja.tambah');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // $perusahaan = new MitraPerusahaan();
    // $perusahaan->lowongan()->create($request->all());
    $lowongan = new LowonganKerja;
    $lowongan->judul_lowongan = $request->input('judul_lowongan');
    $lowongan->deskripsi_lowongan = $request->input('deskripsi_lowongan');
    $lowongan->tanggal_dimulai = $request->input('tanggal_dimulai');
    $lowongan->tanggal_berakhir = $request->input('tanggal_berakhir');
    $lowongan->id_perusahaan = 2;
    $lowongan->save();

    return redirect()->route('perusahaan.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $lowongan = collect(DB::select('SELECT*FROM lowongan_kerja WHERE id_lowongan = :nomor', [
      'nomor' => $id
    ]))->first();

    return view('perusahaan.lowongankerja.detail', compact('lowongan'));
  }

  public function edit($id)
  {
    $lowongan = collect(DB::select('SELECT*FROM lowongan_kerja WHERE id_lowongan = :nomor', [
      'nomor' => $id
    ]))->first();

    return view('perusahaan.lowongankerja.sunting', compact('lowongan'));
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
    $validatedData = $request->only(['judul_lowongan', 'deskripsi_lowongan', 'tanggal_dimulai', 'tanggal_berakhir']);
    LowonganKerja::whereIdLowongan($id)->update($validatedData);

    return redirect()->route('perusahaan.lowongankerja.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      $deleteLowongan = DB::delete("DELETE FROM lowongan_kerja WHERE id_lowongan = :id", compact('id'));

      if ($deleteLowongan) return redirect()->back()->with('sukses', 'Berhasil hapus data lowongan');
      else return redirect()->back()->with('error', 'Gagal menghapus data lowongan');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
