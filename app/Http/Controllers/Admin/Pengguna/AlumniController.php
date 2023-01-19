<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Helpers\Helper;
use App\Models\User;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreAlumniRequest;
use App\Models\SiswaAlumni;
use Illuminate\Support\Facades\{DB, Hash};
use Illuminate\Support\{Collection, ItemNotFoundException};
use Spatie\QueryBuilder\QueryBuilder;
use Yajra\DataTables\DataTables;

class AlumniController extends Controller {
  use HasMainRoute;

  public function __construct() {
    $this->setMainRoute('admin.alumni.index');
  }

  private function getJurusan(): Collection {
    return collect(DB::select('SELECT * FROM jurusan'));
  }

  private function getAngkatan(): Collection {
    return collect(DB::select('SELECT * FROM angkatan'));
  }

  private function getOneAlumniByUsername(string $username): object {
    return collect(DB::select('CALL get_one_alumni_by_username(?)', [$username]))->firstOrFail();
  }

  private function generateAlumniUsername(string $name): string {
    return Helper::generateUniqueUsername('ALUMNI', 5, $name);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $alumni = QueryBuilder::for(SiswaAlumni::class)
      ->allowedFilters(['nama_lengkap', 'nis'])
      ->allowedSorts('id')
      ->allowedIncludes(['jurusan', 'angkatan'])
      ->with(['jurusan', 'angkatan', 'pelamar'])
      ->get();

    return view('admin.pengguna.alumni.index', compact('alumni'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
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
  public function store(StoreAlumniRequest $request) {
    try {
      $validatedData = $request->validatedDataAlumni();
      $validatedData['username'] = $validatedData['nis'];

      $insertOneAlumni = DB::insert("CALL insert_one_siswa_alumni(:username, :email, :password, :jurusan, :angkatan, :nis, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_telp, :alamat_alumni, :foto_alumni)", [
        'username' => $validatedData['username'],
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
        'email' => NULL
      ]);

      if ($insertOneAlumni) return $this->redirectToMainRoute()->with('sukses', 'Berhasil Menambahkan Data Alumni');
      else return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (\Exception $e) {
      return $this->redirectToMainRoute()->with('error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  string  $username
   * @return \Illuminate\Http\Response
   */
  public function show(string $username) {
    try {
      $alumni = $this->getOneAlumniByUsername($username);
      return view('admin.pengguna.alumni.detail', compact('alumni'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data alumni tidak ditemukan');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  string  $username
   * @return \Illuminate\Http\Response
   */
  public function edit(string $username) {
    try {
      $jurusan = $this->getJurusan();
      $angkatan = $this->getAngkatan();
      $alumni = $this->getOneAlumniByUsername($username);
      return view('admin.pengguna.alumni.sunting', compact('jurusan', 'angkatan', 'alumni'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data alumni tidak ditemukan');
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $username
   * @return \Illuminate\Http\Response
   */
  public function update(StoreAlumniRequest $request, string $username) {
    try {
      $alumni = $this->getOneAlumniByUsername($username);
      $validatedData = $request->validatedDataAlumni();

      if ($request->hasFile('foto_alumni')) Helper::deleteFileIfExistsInStorageFolder($alumni->foto);

      if ($alumni->nis !== $validatedData['nis']) :
        $validatedData['password'] = Hash::make($validatedData['nis']);
        $validatedData['new_username'] = $validatedData['nis'];
      else :
        $validatedData['password'] = null;
        $validatedData['new_username'] = null;
      endif;

      $updateOneAlumni = DB::update("CALL update_one_siswa_alumni_by_username(:old_username, :new_username, :password, :jurusan, :angkatan, :nis, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_telp, :alamat_alumni, :foto_alumni)", [
        'old_username' =>  $alumni->username ?? $username,
        'new_username' => $validatedData['new_username'],
        'password' => $validatedData['password'],
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

      if ($updateOneAlumni) return $this->redirectToMainRoute()->with('sukses', 'Berhasil Memperbarui Data Alumni');
      else return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data alumni tidak ditemukan');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  string  $username
   * @return \Illuminate\Http\Response
   */
  public function destroy(string $username) {
    try {
      $alumni = $this->getOneAlumniByUsername($username);
      $deleteAlumni = User::whereUsername($alumni->username)->delete();
      Helper::deleteFileIfExistsInStorageFolder($alumni->foto);

      if ($deleteAlumni) return back()->with('sukses', 'Berhasil hapus data alumni');
      else return back()->with('error', 'Gagal menghapus data alumni');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
