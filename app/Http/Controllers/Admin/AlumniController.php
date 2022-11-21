<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $alumni = DB::select(
      'SELECT * FROM siswa_alumni AS sa
      INNER JOIN angkatan AS agkt ON sa.id_angkatan = agkt.id_angkatan'
    );
    return view('admin.pengguna.alumni.index', compact('alumni'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.pengguna.alumni.tambah');
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
  public function show($nis)
  {
    $alumni = collect(DB::select(
      "SELECT
        sa.id_siswa,
        p.id_pelamar,
        agkt.id_angkatan,
        jrs.id_jurusan,
        u.id_user,
        lu.id_level,
        sa.nis,
        sa.nama_lengkap,
        sa.jenis_kelamin,
        sa.tempat_lahir,
        sa.tanggal_lahir,
        sa.no_telepon,
        sa.alamat_tempat_tinggal,
        sa.foto,
        agkt.angkatan_tahun,
        jrs.nama_jurusan,
        jrs.keterangan,
        u.username,
        lu.nama_level
      FROM siswa_alumni AS sa
      INNER JOIN pelamar AS p ON sa.id_pelamar = p.id_pelamar
      INNER JOIN angkatan AS agkt ON sa.id_angkatan = agkt.id_angkatan
      INNER JOIN jurusan AS jrs ON sa.id_jurusan = jrs.id_jurusan
      INNER JOIN users AS u ON p.id_user = u.id_user
      INNER JOIN level_user AS lu ON u.id_level = lu.id_level
      WHERE nis = ?",
      [$nis]
    ))->first();
    return view('admin.pengguna.alumni.detail', compact('alumni'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('admin.pengguna.alumni.sunting');
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
