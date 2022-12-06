<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreAlumniRequest;
use App\Traits\HasMainRoute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ItemNotFoundException;

class AlumniController extends Controller
{
  use HasMainRoute;

  public function __construct()
  {
    $this->setMainRoute('admin.alumni.index');
  }

  private function getJurusan(): Collection
  {
    return collect(DB::select('SELECT * FROM jurusan'));
  }

  private function getAngkatan(): Collection
  {
    return collect(DB::select('SELECT * FROM angkatan'));
  }

  private function getOneAlumniByNis(string $nis)
  {
    return collect(DB::select('CALL get_one_alumni_by_nis(?)', [$nis]))->firstOrFail();
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
      $validatedData = $request->validatedAlumniAttr();
      $insertOneAlumni = DB::insert("CALL insert_one_siswa_alumni(:password, :jurusan, :angkatan, :nis, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_telp, :alamat_alumni, :foto_alumni, :username, :email)", [
        'password' => Hash::make($validatedData['nis']),
        'jurusan' => $validatedData['jurusan'],
        'angkatan' => $validatedData['angkatan'],
        'nis' => $validatedData['nis'],
        'nama' => $validatedData['nama'],
        'jenis_kelamin' => $validatedData['jenis_kelamin'],
        'tempat_lahir' => $validatedData['tempat_lahir'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
        'no_telp' => $validatedData['no_telp'],
        'alamat_alumni' => $validatedData['alamat_alumni'],
        'foto_alumni' => $validatedData['foto_alumni'],
        'username' => NULL,
        'email' => NULL
      ]);

      if ($insertOneAlumni)
        return $this->redirectToMainRoute()->with('sukses', 'Berhasil Menambahkan Data Alumni');
      else
        return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (\Exception $e) {
      return $this->redirectToMainRoute()->with('error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  string  $nis
   * @return \Illuminate\Http\Response
   */
  public function show(string $nis)
  {
    try {
      if (strlen($nis) > 18)
        return $this->redirectToMainRoute()->with('error', 'Parameter nis tidak boleh lebih dari 18 karakter');

      $alumni = $this->getOneAlumniByNis($nis);
      return view('admin.pengguna.alumni.detail', compact('alumni'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data alumni tidak ditemukan');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  string  $nis
   * @return \Illuminate\Http\Response
   */
  public function edit(string $nis)
  {
    try {
      if (strlen($nis) > 18)
        return $this->redirectToMainRoute()->with('error', 'Parameter nis tidak boleh lebih dari 18 karakter');

      $jurusan = $this->getJurusan();
      $angkatan = $this->getAngkatan();
      $alumni = $this->getOneAlumniByNis($nis);
      return view('admin.pengguna.alumni.sunting', compact('jurusan', 'angkatan', 'alumni'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data alumni tidak ditemukan');
    }
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
    try {
      if (strlen($nis) > 18)
        return $this->redirectToMainRoute()->with('error', 'Parameter nis tidak boleh lebih dari 18 karakter');

      $alumni = $this->getOneAlumniByNis($nis);
      $validatedData = $request->validatedAlumniAttr();

      if ($alumni->nis !== $validatedData['nis']) $validatedData['hashing_nis'] = Hash::make($validatedData['nis']);
      else $validatedData['hashing_nis'] = null;

      $updateOneAlumni = DB::update("CALL update_one_siswa_alumni_by_nis(:current_nis, :id_user, :hashing_nis, :jurusan, :angkatan, :nis, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_telp, :alamat_alumni, :foto_alumni)", [
        'current_nis' => $nis ?? $alumni->nis,
        'id_user' => $alumni->id_user,
        'hashing_nis' => $validatedData['hashing_nis'],
        'jurusan' => $validatedData['jurusan'],
        'angkatan' => $validatedData['angkatan'],
        'nis' => $validatedData['nis'],
        'nama' => $validatedData['nama'],
        'jenis_kelamin' => $validatedData['jenis_kelamin'],
        'tempat_lahir' => $validatedData['tempat_lahir'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
        'no_telp' => $validatedData['no_telp'],
        'alamat_alumni' => $validatedData['alamat_alumni'],
        'foto_alumni' => $validatedData['foto_alumni'],
      ]);

      if ($updateOneAlumni)
        return $this->redirectToMainRoute()->with('sukses', 'Berhasil Memperbarui Data Alumni');
      else
        return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data alumni tidak ditemukan');
    }
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
      $alumni = $this->getOneAlumniByNis($nis);
      $deleteAlumni = User::whereUsername($alumni->username)->delete();

      if ($deleteAlumni) return back()->with('sukses', 'Berhasil hapus data alumni');
      else return back()->with('error', 'Gagal menghapus data alumni');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
