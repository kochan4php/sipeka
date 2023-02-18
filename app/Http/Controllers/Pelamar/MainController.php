<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pelamar;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Contracts\View\View;
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
        $user = User::whereUsername($username)->first();
        $data = UserHelper::getApplicantData($user->pelamar);

        if (Auth::check() && Auth::user()->pelamar->alumni) {
            $jurusan = Jurusan::all();
            $angkatan = Angkatan::all();
            return view('pelamar.alumni_profile.edit', compact('data', 'jurusan', 'angkatan'));
        } else {
            return view('pelamar.kandidat_luar_profile.edit', compact('data'));
        }
    }

    public function profileUpdate(Request $request, string $username): void {
        $user = User::firstWhere('username', $username);

        if ($request->input('username') !== $user->username) {
            $user->update(['username' => $request->input('username')]);
        }

        dd($request->all(), $user);
    }
}
