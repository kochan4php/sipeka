<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MitraPerusahaanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $perusahaan = collect(DB::select(
      "SELECT * FROM mitra_perusahaan AS mp
      INNER JOIN users AS u ON mp.id_user = u.id_user"
    ));
    return view('admin.pengguna.perusahaan.index', compact('perusahaan'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.pengguna.perusahaan.tambah');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    return 'Hehe berhasil';
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($username)
  {
    $perusahaan = collect(DB::select(
      "SELECT
        mp.id_perusahaan,
        u.id_user,
        lu.id_level,
        mp.nama_perusahaan,
        mp.nomor_telp_perusahaan,
        mp.thumbnail_perusahaan,
        mp.logo_perusahaan,
        mp.deskripsi_perusahaan,
        mp.alamat_perusahaan,
        u.username,
        u.email,
        lu.nama_level
      FROM mitra_perusahaan AS mp
      INNER JOIN users AS u ON mp.id_user = u.id_user
      INNER JOIN level_user AS lu ON u.id_level = lu.id_level
      WHERE u.username = ?",
      [$username]
    ))->first();
    return view('admin.pengguna.perusahaan.detail', compact('perusahaan'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('admin.pengguna.perusahaan.sunting');
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
    return 'Hehe berhasil';
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    return 'Berhasil hapus data';
  }
}
