<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreAlumniRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;

use function GuzzleHttp\Promise\all;

class AlumniController extends Controller
{
  private function getJurusan(): Collection
  {
    return collect(DB::select('SELECT * FROM jurusan'));
  }

  private function getAngkatan(): Collection
  {
    return collect(DB::select('SELECT * FROM angkatan'));
  }

  private function getAlumniByNis(string $nis)
  {
    return collect(DB::select('CALL get_alumni_by_nis(?)', [$nis]))->first();
  }

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
    $jurusan = $this->getJurusan();
    $angkatan = $this->getAngkatan();
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

      $validatedData['tempat_lahir'] = !is_null($validatedData['tempat_lahir']) ?
        $validatedData['tempat_lahir'] : null;

      $validatedData['tanggal_lahir'] = !is_null($validatedData['tanggal_lahir']) ?
        Carbon::parse($validatedData['tanggal_lahir']) : null;

      $validatedData['no_telp'] = !is_null($validatedData['no_telp']) ?
        $validatedData['no_telp'] : null;

      $validatedData['alamat_alumni'] = !is_null($validatedData['alamat_alumni']) ?
        $validatedData['alamat_alumni'] : null;

      $validatedData['foto_alumni'] = !is_null($validatedData['foto_alumni']) ?
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
  public function show(string $nis)
  {
    $alumni = $this->getAlumniByNis($nis);
    return view('admin.pengguna.alumni.detail', compact('alumni'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  string  $nis
   * @return \Illuminate\Http\Response
   */
  public function edit(string $nis)
  {
    $jurusan = $this->getJurusan();
    $angkatan = $this->getAngkatan();
    $alumni = $this->getAlumniByNis($nis);
    return view('admin.pengguna.alumni.sunting', compact('jurusan', 'angkatan', 'alumni'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $nis
   * @return \Illuminate\Http\Response
   */
  public function update(StoreAlumniRequest $request, string $nis)
  {
    return 'Hehe berhasil';
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  string  $nis
   * @return \Illuminate\Http\Response
   */
  public function destroy(string $nis)
  {
    try {
      $alumni = $this->getAlumniByNis($nis);
      $deleteAlumni = DB::table('users')->where('username', '=', "{$alumni->username}")->delete();

      if ($deleteAlumni) return redirect()->back()->with('sukses', 'Berhasil hapus data alumni');
      else return redirect()->back()->with('error', 'Gagal menghapus data alumni');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
