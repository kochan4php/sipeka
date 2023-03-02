<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegistrasiKandidatRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{DB, Hash};

final class RegistrationController extends Controller {
    public function kandidat(): View {
        return view('auth.register.kandidat');
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
}
