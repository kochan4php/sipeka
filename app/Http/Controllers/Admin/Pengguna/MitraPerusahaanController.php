<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreMitraPerusahaanRequest;
use App\Models\User;
use App\Traits\HasMainRoute;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ItemNotFoundException;

class MitraPerusahaanController extends Controller
{
  use HasMainRoute;

  public function __construct()
  {
    $this->setMainRoute('admin.perusahaan.index');
  }

  private function getAllPerusahaan(): Collection
  {
    return collect(DB::select('SELECT * FROM get_all_perusahaan'));
  }

  private function getOnePerusahaanByUsername(string $username)
  {
    return collect(DB::select('CALL get_one_perusahaan_by_username(?)', [$username]))->firstOrFail();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $perusahaan = $this->getAllPerusahaan();
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
  public function store(StoreMitraPerusahaanRequest $request)
  {
    try {
      $validatedData = $request->validatedMitraPerusahaanAttr();

      $insertOnePerusahaan = DB::insert("CALL insert_one_perusahaan(:email_perusahaan, :password_perusahaan, :nama_perusahaan, :nomor_telp_perusahaan, :alamat_perusahaan, :foto_sampul_perusahaan, :logo_perusahaan, :deskripsi_perusahaan)", [
        'email_perusahaan' => $validatedData['email_perusahaan'],
        'password_perusahaan' => Hash::make($validatedData['password_perusahaan']),
        'nama_perusahaan' => $validatedData['nama_perusahaan'],
        'nomor_telp_perusahaan' => $validatedData['no_telepon_perusahaan'],
        'alamat_perusahaan' => $validatedData['alamat_perusahaan'],
        'foto_sampul_perusahaan' => $validatedData['foto_sampul_perusahaan'],
        'logo_perusahaan' => $validatedData['logo_perusahaan'],
        'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
      ]);

      if ($insertOnePerusahaan)
        return $this->redirectToMainRoute()->with('sukses', 'Berhasil Menambahkan Data Mitra Perusahaan');
      else
        return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
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
  public function show(string $username)
  {
    try {
      $perusahaan = $this->getOnePerusahaanByUsername($username);
      return view('admin.pengguna.perusahaan.detail', compact('perusahaan'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data perusahaan tidak ditemukan');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  string  $username
   * @return \Illuminate\Http\Response
   */
  public function edit(string $username)
  {
    try {
      $perusahaan = $this->getOnePerusahaanByUsername($username);
      return view('admin.pengguna.perusahaan.sunting', compact('perusahaan'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data pelamar tidak ditemukan');
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $username
   * @return \Illuminate\Http\Response
   */
  public function update(StoreMitraPerusahaanRequest $request, string $username)
  {
    try {
      $perusahaan = $this->getOnePerusahaanByUsername($username);
      $validatedData = $request->validatedMitraPerusahaanAttr();

      $validatedData['password_perusahaan'] =
        Hash::check($validatedData['password_perusahaan'], $perusahaan->password) ?
        null : Hash::make($validatedData['password_perusahaan']);

      $updateOnePerusahaan = DB::update("CALL update_one_perusahaan_by_username(:current_username, :email, :new_password, :nama_perusahaan, :nomor_telp_perusahaan, :alamat_perusahaan, :foto_sampul_perusahaan, :logo_perusahaan, :deskripsi_perusahaan)", [
        'current_username' => $perusahaan->username,
        'email' => $validatedData['email_perusahaan'],
        'new_password' => $validatedData['password_perusahaan'],
        'nama_perusahaan' => $validatedData['nama_perusahaan'],
        'nomor_telp_perusahaan' => $validatedData['no_telepon_perusahaan'],
        'alamat_perusahaan' => $validatedData['alamat_perusahaan'],
        'foto_sampul_perusahaan' => $validatedData['foto_sampul_perusahaan'],
        'logo_perusahaan' => $validatedData['logo_perusahaan'],
        'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan']
      ]);

      if ($updateOnePerusahaan)
        return $this->redirectToMainRoute()->with('sukses', 'Berhasil Memperbarui Data Mitra Perusahaan');
      else
        return back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error',  'Data Mitra Perusahaan tidak ditemukan');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  string  $username
   * @return \Illuminate\Http\Response
   */
  public function destroy(string $username)
  {
    try {
      $perusahaan = $this->getOnePerusahaanByUsername($username);
      $perusahaan = User::whereUsername($perusahaan->username)->delete();

      if ($perusahaan) return back()->with('sukses', 'Berhasil hapus data Mitra Perusahaan');
      else return back()->with('error', 'Gagal menghapus data Mitra Perusahaan');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
