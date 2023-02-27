<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\{StoreRegistrasiAlumniRequest, StoreRegistrasiKandidatRequest};
use App\Models\Angkatan;
use App\Models\Jurusan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{DB, Hash};

final class RegistrationController extends Controller {
    public function kandidat(): View {
        return view('auth.register.kandidat');
    }

    public function alumni(): View {
        $jurusan = Jurusan::all();
        $angkatan = Angkatan::all();

        return view('auth.register.alumni', compact('jurusan', 'angkatan'));
    }

    public function kandidatStore(StoreRegistrasiKandidatRequest $request): RedirectResponse {
        $validatedData = $request->validatedDataKandidat();
        $registerKandidat = DB::insert("CALL insert_one_person(:username, :email, :password, :nama_lengkap, :jenis_kelamin, :no_telepon, :tempat_lahir, :tanggal_lahir, :alamat_tempat_tinggal, :foto, :public_foto_id)", [
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
            'public_foto_id' => NULL
        ]);

        if ($registerKandidat) return to_route('login');
        else return back()->withErrors(['Data tidak valid! Silahkan coba lagi.']);
    }

    public function alumniStore(StoreRegistrasiAlumniRequest $request): RedirectResponse {
        $validatedData = $request->validatedDataAlumni();
        $registerAlumni = DB::insert("CALL insert_one_siswa_alumni(:username, :email, :password, :jurusan, :angkatan, :nis, :nama, :jenis_kelamin, :tempat_lahir, :tanggal_lahir, :no_telp, :alamat_alumni, :foto_alumni)", [
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

        if ($registerAlumni) return to_route('login');
        else return back()->withErrors(['Data tidak valid! Silahkan coba lagi.']);
    }
}
