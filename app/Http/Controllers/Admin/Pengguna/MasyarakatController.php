<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StorePersonRequest;
use App\Models\User;
use App\Traits\HasMainRoute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasyarakatController extends Controller
{
  use HasMainRoute;

  public function __construct()
  {
    $this->setMainRoute('admin.pelamar.index');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $masyarakat = collect(DB::select('SELECT * FROM get_all_masyarakat'));
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
  public function show($username)
  {
    $masyarakat = collect(DB::select('CALL get_one_masyarakat_by_username(?)', [$username]))->first();
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
  public function update(StorePersonRequest $request, $id)
  {
    return 'Hehe berhasil';
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  string  $username
   * @return \Illuminate\Http\Response
   */
  public function destroy($username)
  {
    try {
      $person = collect(DB::select('CALL get_one_masyarakat_by_username(?)', [$username]))->first();
      $deletePerson = User::whereUsername($person->username)->delete();

      if ($deletePerson) return redirect()->back()->with('sukses', 'Berhasil hapus data pelamar');
      else return redirect()->back()->with('error', 'Gagal menghapus data pelamar');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }
  }
}
