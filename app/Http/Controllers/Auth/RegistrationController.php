<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{StoreRegistrasiAlumniRequest, StoreRegistrasiKandidatRequest};
use Illuminate\Support\Facades\{DB, Hash};
use App\Helpers\Helper;

class RegistrationController extends Controller
{
  public function kandidat()
  {
    return view('auth.register.kandidat');
  }

  public function alumni()
  {
    $jurusan = collect(DB::select('SELECT * FROM jurusan'));
    $angkatan = collect(DB::select('SELECT * FROM angkatan'));
    return view('auth.register.alumni', compact('jurusan', 'angkatan'));
  }

  public function kandidatStore(StoreRegistrasiKandidatRequest $request)
  {
    $validatedData = $request->validatedRegistrasiKandidatAttr();

    $registerKandidat = DB::insert("CALL insert_one_person(:username, :email, :password, :nama_lengkap, :jenis_kelamin, :no_telepon, :tempat_lahir, :tanggal_lahir, :alamat_tempat_tinggal, :foto)", [
      'username' => $validatedData['username'],
      'email' => $validatedData['email'],
      'password' => Hash::make($validatedData['password']),
      'nama_lengkap' => $validatedData['nama'],
      'no_telepon' => $validatedData['no_telp'],
      'jenis_kelamin' => $validatedData['jenis_kelamin'],
      'tempat_lahir' => NULL,
      'tanggal_lahir' => NULL,
      'alamat_tempat_tinggal' => NULL,
      'foto' => NULL,
    ]);

    if ($registerKandidat) return redirect(route('login'));
    else return back()->withErrors(['Data tidak valid! Silahkan coba lagi.']);
  }

  public function alumniStore(StoreRegistrasiAlumniRequest $request)
  {
    $validatedData = $request->validatedRegistrasiAlumniAttr();
    $registerAlumni = DB::insert("CALL insert_one_siswa_alumni(:password, :jurusan, :angkatan, :nis, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_telp, :alamat_alumni, :foto_alumni, :username, :email)", [
      'username' => $validatedData['username'],
      'email' => $validatedData['email'],
      'password' => Hash::make($validatedData['password']),
      'jurusan' => $validatedData['jurusan'],
      'angkatan' => $validatedData['angkatan'],
      'nis' => $validatedData['nis'],
      'nama' => $validatedData['nama'],
      'jenis_kelamin' => $validatedData['jenis_kelamin'],
      'tempat_lahir' => NULL,
      'tanggal_lahir' => NULL,
      'no_telp' => NULL,
      'alamat_alumni' => NULL,
      'foto_alumni' => NULL,
    ]);

    if ($registerAlumni) return redirect(route('login'));
    else return back()->withErrors(['Data tidak valid! Silahkan coba lagi.']);
  }
}
