<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StorePersonRequest;
use App\Models\User;
use App\Traits\HasMainRoute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ItemNotFoundException;

class MasyarakatController extends Controller
{
  use HasMainRoute;

  public function __construct()
  {
    $this->setMainRoute('admin.pelamar.index');
  }

  private function getAllPersons()
  {
    return collect(DB::select('SELECT * FROM get_all_masyarakat'));
  }

  private function getOnePersonByUsername(string $username)
  {
    return collect(DB::select('CALL get_one_masyarakat_by_username(?)', [$username]))->firstOrFail();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $masyarakat = $this->getAllPersons();
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
  public function store(StorePersonRequest $request)
  {
    try {
      $validatedData = $request->validatedPersonAttr();

      $insertOnePerson = DB::insert("CALL insert_one_person(:email, :password, :nama_lengkap, :jenis_kelamin, :no_telepon, :tempat_lahir, :tanggal_lahir, :alamat_tempat_tinggal, :foto)", [
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'nama_lengkap' => $validatedData['nama'],
        'jenis_kelamin' => $validatedData['jenis_kelamin'],
        'no_telepon' => $validatedData['no_telp'],
        'tempat_lahir' => $validatedData['tempat_lahir'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
        'alamat_tempat_tinggal' => $validatedData['alamat'],
        'foto' => $validatedData['foto_pelamar']
      ]);

      if ($insertOnePerson)
        return $this->redirectToMainRoute()->with('sukses', 'Berhasil Menambahkan Data Pelamar');
      else
        return redirect()->back()->with('error', 'Data tidak valid, silahkan periksa kembali');
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
      $orang = $this->getOnePersonByUsername($username);
      return view('admin.pengguna.masyarakat.detail', compact('orang'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data pelamar tidak ditemukan');
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
      $orang = $this->getOnePersonByUsername($username);
      return view('admin.pengguna.masyarakat.sunting', compact('orang'));
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
  public function update(StorePersonRequest $request, string $username)
  {
    try {
      $person = $this->getOnePersonByUsername($username);
      $validatedData = $request->validatedPersonAttr();

      $updatePerson = DB::update("CALL update_one_person_by_username(:current_username, :email, :nama_lengkap, :jenis_kelamin, :no_telepon, :tempat_lahir, :tanggal_lahir, :alamat_tempat_tinggal, :foto)", [
        'current_username' => $username,
        'email' => $validatedData['email'],
        'nama_lengkap' => $validatedData['nama'],
        'jenis_kelamin' => $validatedData['jenis_kelamin'],
        'no_telepon' => $validatedData['no_telp'],
        'tempat_lahir' => $validatedData['tempat_lahir'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
        'alamat_tempat_tinggal' => $validatedData['alamat'],
        'foto' => $validatedData['foto_pelamar']
      ]);

      if ($updatePerson)
        return $this->redirectToMainRoute()->with('sukses', 'Berhasil Memperbarui Data Pelamar');
      else
        return redirect()->back()->with('error', 'Data tidak valid, silahkan periksa kembali');
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data pelamar tidak ditemukan');
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
      $orang = $this->getOnePersonByUsername($username);
      $deleteOrang = User::whereUsername($orang->username)->delete();

      if ($deleteOrang) return redirect()->back()->with('sukses', 'Berhasil hapus data pelamar');
      else return redirect()->back()->with('error', 'Gagal menghapus data pelamar');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
