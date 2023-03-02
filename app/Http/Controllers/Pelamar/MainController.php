<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pelamar;

use App\Helpers\Helper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class MainController extends Controller {
    public function __invoke(): View {
        $data = UserHelper::getApplicantData(Auth::user()->pelamar);

        return (Auth::check() && Auth::user()->pelamar->alumni) ?
            view('pelamar.profile_alumni', compact('data')) :
            view('pelamar.profile_kandidat_luar', compact('data'));
    }

    public function profileEdit(string $username): View {
        $data = [];

        if (Auth::check() && Auth::user()->alumni) {
            $jurusan = Jurusan::all();
            $angkatan = Angkatan::all();
            $data = Auth::user()->alumni;

            return view('pelamar.alumni_profile.edit', compact('data', 'jurusan', 'angkatan'));
        } else {
            $data = Auth::user()->masyarakat;
            return view('pelamar.kandidat_luar_profile.edit', compact('data'));
        }
    }

    public function profileUpdate(Request $request, string $username): RedirectResponse {
        $user = User::firstWhere('username', $username);

        if ($request->input('username') !== $user->username) {
            $user->update(['username' => $request->input('username')]);
        }

        $data = [];

        if (Auth::user()->alumni) $data = Auth::user()->pelamar->alumni;
        else $data = Auth::user()->pelamar->masyarakat;

        $rules = [
            'username' => ['required', 'min:5', 'max:255', 'alpha_num'],
            'nama_lengkap' => ['required', 'max:255'],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'no_telepon' => ['required', 'numeric'],
            'alamat' => ['nullable'],
            'foto' => ['nullable']
        ];

        if (Auth::user()->alumni) {
            $rules['nis'] = ['required', 'numeric'];
            $rules['id_jurusan'] = ['required'];
            $rules['id_angkatan'] = ['required'];
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            Helper::deleteFileIfExistsInStorageFolder($data->foto);
            $validatedData['foto'] = $image->store('profile-pelamar');
        }

        if (Auth::user()->alumni) {
            $alumni = Auth::user()->pelamar->alumni;
            $alumni->update($validatedData);
        } else {
            $data = Auth::user()->pelamar->masyarakat;
            $data->update($validatedData);
        }

        notify()->success('Berhasil memperbarui profil');
        return to_route('pelamar.index', $username);
    }
}
