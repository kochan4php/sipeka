<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Helpers\Helper;
use App\Models\User;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreMitraPerusahaanRequest;
use App\Models\MitraPerusahaan;
use Illuminate\Support\{Collection, ItemNotFoundException};
use Illuminate\Support\Facades\{DB, Hash};
use Spatie\QueryBuilder\QueryBuilder;

class MitraPerusahaanController extends Controller {
  use HasMainRoute;

  public function __construct() {
    $this->setMainRoute('admin.perusahaan.index');
  }

  private function getAllPerusahaan(): Collection {
    return collect(DB::select('SELECT * FROM get_all_perusahaan'));
  }

  private function getOnePerusahaanByUsername(string $username): object {
    return collect(DB::select('CALL get_one_perusahaan_by_username(?)', [$username]))->firstOrFail();
  }

  private function generatePerusahaanUsername(string $name): string {
    return Helper::generateUniqueUsername('PRSHN', 5, $name);
  }

  public function index() {
    $perusahaan = QueryBuilder::for(MitraPerusahaan::class)
      ->allowedFilters('nama_perusahaan')
      ->allowedSorts('id')
      ->with('user')
      ->get();

    return view('admin.pengguna.perusahaan.index', compact('perusahaan'));
  }

  public function create() {
    return view('admin.pengguna.perusahaan.tambah');
  }

  public function store(StoreMitraPerusahaanRequest $request) {
    try {
      $validatedData = $request->validatedDataPerusahaan();
      $validatedData['username_perusahaan'] = $this->generatePerusahaanUsername($validatedData['nama_perusahaan']);

      DB::insert("CALL insert_one_perusahaan(:username_perusahaan, :email_perusahaan, :password_perusahaan, :nama_perusahaan, :nomor_telp_perusahaan, :alamat_perusahaan, :foto_sampul_perusahaan, :logo_perusahaan, :deskripsi_perusahaan, :jenis_perusahaan)", [
        'username_perusahaan' => $validatedData['username_perusahaan'],
        'email_perusahaan' => $validatedData['email_perusahaan'],
        'password_perusahaan' => Hash::make($validatedData['password_perusahaan']),
        'nama_perusahaan' => $validatedData['nama_perusahaan'],
        'nomor_telp_perusahaan' => $validatedData['no_telepon_perusahaan'],
        'alamat_perusahaan' => $validatedData['alamat_perusahaan'],
        'foto_sampul_perusahaan' => $validatedData['foto_sampul_perusahaan'],
        'logo_perusahaan' => $validatedData['logo_perusahaan'],
        'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
        'jenis_perusahaan' => $validatedData['jenis_perusahaan']
      ]);

      return $this->redirectToMainRoute()->with('sukses', 'Berhasil Menambahkan Data Mitra Perusahaan');
    } catch (\Exception $e) {
      return $this->redirectToMainRoute()->with('error', $e->getMessage());
    }
  }

  public function show(string $username) {
    try {
      $perusahaan = $this->getOnePerusahaanByUsername($username);

      return view('admin.pengguna.perusahaan.detail', compact('perusahaan'));
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data perusahaan tidak ditemukan');
    }
  }

  public function edit(string $username) {
    try {
      $perusahaan = $this->getOnePerusahaanByUsername($username);

      return view('admin.pengguna.perusahaan.sunting', compact('perusahaan'));
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data perusahaan tidak ditemukan');
    }
  }

  public function update(StoreMitraPerusahaanRequest $request, string $username) {
    try {
      $perusahaan = $this->getOnePerusahaanByUsername($username);
      $validatedData = $request->validatedDataPerusahaan();

      if ($request->hasFile('foto_sampul_perusahaan') || $request->hasFile('logo_perusahaan')) {
        Helper::deleteMultipleFileIfExistsInStorageFolder(
          $perusahaan->foto_sampul_perusahaan,
          $perusahaan->logo_perusahaan
        );
      }

      if ($perusahaan->nama_perusahaan !== $validatedData['nama_perusahaan']) {
        $validatedData['new_username_perusahaan'] = $this->generatePerusahaanUsername($validatedData['nama_perusahaan']);
      } else {
        $validatedData['new_username_perusahaan'] = null;
      }

      DB::update("CALL update_one_perusahaan_by_username(:old_username, :new_username_perusahaan, :email_perusahaan, :nama_perusahaan, :nomor_telp_perusahaan, :alamat_perusahaan, :foto_sampul_perusahaan, :logo_perusahaan, :deskripsi_perusahaan, :jenis_perusahaan)", [
        'old_username' => $perusahaan->username,
        'new_username_perusahaan' => $validatedData['new_username_perusahaan'],
        'email_perusahaan' => $validatedData['email_perusahaan'],
        'nama_perusahaan' => $validatedData['nama_perusahaan'],
        'nomor_telp_perusahaan' => $validatedData['no_telepon_perusahaan'],
        'alamat_perusahaan' => $validatedData['alamat_perusahaan'],
        'foto_sampul_perusahaan' => $validatedData['foto_sampul_perusahaan'],
        'logo_perusahaan' => $validatedData['logo_perusahaan'],
        'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
        'jenis_perusahaan' => $validatedData['jenis_perusahaan']
      ]);

      return $this->redirectToMainRoute()->with('sukses', 'Berhasil Memperbarui Data Mitra Perusahaan');
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error',  'Data Mitra Perusahaan tidak ditemukan');
    }
  }

  public function destroy(string $username) {
    try {
      $perusahaan = $this->getOnePerusahaanByUsername($username);
      User::whereUsername($perusahaan->username)->delete();
      Helper::deleteMultipleFileIfExistsInStorageFolder($perusahaan->foto_sampul_perusahaan, $perusahaan->logo_perusahaan);

      return back()->with('sukses', 'Berhasil hapus data Mitra Perusahaan');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
