<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreAlumniRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AlumniController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $alumni = collect(DB::select('SELECT * FROM get_all_siswa_alumni'));
    return view('admin.pengguna.alumni.index', compact('alumni'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $jurusan = collect(DB::select('SELECT * FROM jurusan'));
    $angkatan = collect(DB::select('SELECT * FROM angkatan'));
    return view('admin.pengguna.alumni.tambah', compact('jurusan', 'angkatan'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreAlumniRequest $request)
  {
    try {
      $validatedData = $request->only([
        'jurusan',
        'angkatan',
        'nis',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp',
        'alamat_alumni',
        'foto_alumni',
      ]);

      $validatedData['tempat_lahir'] = $validatedData['tempat_lahir'] ?
        $validatedData['tempat_lahir'] : null;
      $validatedData['tanggal_lahir'] = $validatedData['tanggal_lahir'] ?
        Carbon::parse($validatedData['tanggal_lahir']) : null;
      $validatedData['no_telp'] = $validatedData['no_telp'] ?
        $validatedData['no_telp'] : null;
      $validatedData['alamat_alumni'] = $validatedData['alamat_alumni'] ?
        $validatedData['alamat_alumni'] : null;
      $validatedData['foto_alumni'] = $validatedData['foto_alumni'] ?
        $validatedData['foto_alumni'] : null;

      $alumni = DB::insert("CALL insert_one_siswa_alumni(:jurusan, :angkatan, :nis, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_telp, :alamat_alumni, :foto_alumni)", [
        'jurusan' => strval($validatedData['jurusan']),
        'angkatan' => strval($validatedData['angkatan']),
        'nis' => strval($validatedData['nis']),
        'nama' => strval($validatedData['nama']),
        'jenis_kelamin' => strval($validatedData['jenis_kelamin']),
        'tempat_lahir' => $validatedData['tempat_lahir'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
        'no_telp' => $validatedData['no_telp'],
        'alamat_alumni' => $validatedData['alamat_alumni'],
        'foto_alumni' => $validatedData['foto_alumni'],
      ]);

      if ($alumni)
        return redirect()->route('admin.alumni.index')->with('sukses', 'Berhasil Menambahkan Data Alumni');
      else
        return redirect()->back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (\Exception $e) {
      return redirect()->route('admin.alumni.index')->with('error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($nis)
  {
    $alumni = collect(DB::select('CALL get_alumni_by_nis(?)', [$nis]))->first();
    return view('admin.pengguna.alumni.detail', compact('alumni'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  string  $nis
   * @return \Illuminate\Http\Response
   */
  public function edit($nis)
  {
    $jurusan = collect(DB::select('SELECT * FROM jurusan'));
    $angkatan = collect(DB::select('SELECT * FROM angkatan'));
    return view('admin.pengguna.alumni.sunting', compact('jurusan', 'angkatan'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(StoreAlumniRequest $request, $id)
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
