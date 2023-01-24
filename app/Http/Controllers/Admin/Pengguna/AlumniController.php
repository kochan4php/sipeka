<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Models\User;
use App\Models\SiswaAlumni;
use App\Helpers\Helper;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreAlumniRequest;
use Illuminate\Support\Facades\{DB, Hash};
use Illuminate\Support\{Collection, ItemNotFoundException};
use Spatie\QueryBuilder\QueryBuilder;

final class AlumniController extends Controller {
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

  public function getAllAlumniData() {
    $alumni = QueryBuilder::for(SiswaAlumni::class)
      ->allowedFilters(['nama_lengkap', 'nis'])
      ->allowedSorts('id')
      ->allowedIncludes(['jurusan', 'angkatan'])
      ->with(['jurusan', 'angkatan', 'pelamar'])
      ->get();

    return view('admin.pengguna.alumni.index', compact('alumni'));
  }

  public function createOneAlumniData() {
    $jurusan = $this->getJurusan();
    $angkatan = $this->getAngkatan();
    return view('admin.pengguna.alumni.tambah', compact('jurusan', 'angkatan'));
  }

  public function storeOneAlumniData(StoreAlumniRequest $request) {
    try {
      $validatedData = $request->validatedDataAlumni();
      $validatedData['username'] = $validatedData['nis'];

      DB::insert("CALL insert_one_siswa_alumni(:username, :email, :password, :jurusan, :angkatan, :nis, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_telp, :alamat_alumni, :foto_alumni)", [
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

      notify()->success('Berhasil Menambahkan Data Alumni', 'Notifikasi');

      return $this->redirectToMainRoute();
    } catch (\Exception $e) {
      notify()->error($e->getMessage(), 'Notifikasi');

      return $this->redirectToMainRoute();
    }
  }

  public function getDetailOneAlumniDataByNIS(string $username) {
    try {
      $alumni = $this->getOneAlumniByUsername($username);

      return view('admin.pengguna.alumni.detail', compact('alumni'));
    } catch (ItemNotFoundException) {
      notify()->error('Data alumni tidak ditemukan', 'Notifikasi');

      return $this->redirectToMainRoute();
    }
  }

  public function editOneAlumniData(string $username) {
    try {
      $jurusan = $this->getJurusan();
      $angkatan = $this->getAngkatan();
      $alumni = $this->getOneAlumniByUsername($username);

      return view('admin.pengguna.alumni.sunting', compact('jurusan', 'angkatan', 'alumni'));
    } catch (ItemNotFoundException) {
      notify()->error('Data alumni tidak ditemukan', 'Notifikasi');

      return $this->redirectToMainRoute()->with('error', 'Data alumni tidak ditemukan');
    }
  }

  public function updateOneAlumniData(StoreAlumniRequest $request, string $username) {
    try {
      $alumni = $this->getOneAlumniByUsername($username);
      $validatedData = $request->validatedDataAlumni();

      if ($request->hasFile('foto_alumni')) {
        Helper::deleteFileIfExistsInStorageFolder($alumni->foto);
      }

      if ($alumni->nis !== $validatedData['nis']) {
        $validatedData['password'] = Hash::make($validatedData['nis']);
        $validatedData['new_username'] = $validatedData['nis'];
      } else {
        $validatedData['password'] = null;
        $validatedData['new_username'] = null;
      }

      DB::update("CALL update_one_siswa_alumni_by_username(:old_username, :new_username, :password, :jurusan, :angkatan, :nis, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_telp, :alamat_alumni, :foto_alumni)", [
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

      notify()->success('Berhasil Memperbarui Data Alumni', 'Notifikasi');

      return $this->redirectToMainRoute();
    } catch (ItemNotFoundException) {
      notify()->error('Data alumni tidak ditemukan', 'Notifikasi');

      return $this->redirectToMainRoute();
    }
  }

  public function deleteOneAlumniData(string $username) {
    try {
      $alumni = $this->getOneAlumniByUsername($username);
      User::whereUsername($alumni->username)->delete();
      Helper::deleteFileIfExistsInStorageFolder($alumni->foto);

      notify()->success('Berhasil Hapus Data Alumni', 'Notifikasi');

      return back();
    } catch (\Exception $e) {
      notify()->error($e->getMessage(), 'Notifikasi');

      return back();
    }
  }
}
