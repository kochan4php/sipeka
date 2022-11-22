<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasyarakatController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $masyarakat = collect(DB::select(
      "SELECT
        m.id_masyarakat,
        p.id_pelamar,
        u.id_user,
        m.nama_lengkap,
        m.tanggal_lahir,
        m.no_telepon,
        u.username
      FROM masyarakat AS m
      INNER JOIN pelamar AS p ON m.id_pelamar = p.id_pelamar
      INNER JOIN users AS u ON p.id_user = u.id_user"
    ));
    return view('admin.pengguna.masyarakat.index', compact('masyarakat'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.pengguna.masyarakat.tambah');
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
    $masyarakat = collect(DB::select(
      "SELECT
        m.id_masyarakat,
        p.id_pelamar,
        u.id_user,
        lu.id_level,
        m.nama_lengkap,
        m.jenis_kelamin,
        m.tempat_lahir,
        m.tanggal_lahir,
        m.alamat_tempat_tinggal,
        m.no_telepon,
        m.foto,
        u.username,
        u.email,
        lu.nama_level
      FROM masyarakat AS m
      INNER JOIN pelamar AS p ON m.id_pelamar = p.id_pelamar
      INNER JOIN users AS u ON p.id_user = u.id_user
      INNER JOIN level_user AS lu ON u.id_level = lu.id_level
      WHERE u.username = ?",
      [$username]
    ))->first();
    return view('admin.pengguna.masyarakat.detail', compact('masyarakat'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('admin.pengguna.masyarakat.sunting');
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
