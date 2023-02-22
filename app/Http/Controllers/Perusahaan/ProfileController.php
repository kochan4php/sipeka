<?php

declare(strict_types=1);

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\MitraHasCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class ProfileController extends Controller {
    use MitraHasCategory;

    public function showProfile(): View {
        $mitra = Auth::user()->perusahaan;
        $kategori = $this->kategori;

        return view('perusahaan.profile.index', compact('mitra', 'kategori'));
    }

    public function updateProfile(Request $request) {
        $rules = [
            "nama_perusahaan" => ['required', 'min:5', 'max:255'],
            "username_perusahaan" => ['required'],
            "email_perusahaan" => ['required'],
            "jenis_perusahaan" => ['required'],
            "kategori_perusahaan" => ['required'],
            "nomor_telp_perusahaan" => ['required', 'min:5', 'max:20'],
        ];

        if ($request->username_perusahaan !== Auth::user()->username) {
            $rules['username_perusahaan'] = ['required', 'unique:users,username'];
        }

        if ($request->email_perusahaan !== Auth::user()->email) {
            $rules['email_perusahaan'] = ['required', 'unique:users,email'];
        }

        $request->validate($rules);

        $data = $request->only([
            "nama_perusahaan",
            "username_perusahaan",
            "email_perusahaan",
            "jenis_perusahaan",
            "kategori_perusahaan",
            "nomor_telp_perusahaan",
        ]);

        Auth::user()->update([
            "username" => $data["username_perusahaan"],
            "email" => $data["email_perusahaan"],
        ]);

        Auth::user()->perusahaan()->update([
            "nama_perusahaan" => $data["nama_perusahaan"],
            "jenis_perusahaan" => $data["jenis_perusahaan"],
            "kategori_perusahaan" => $data["kategori_perusahaan"],
            "nomor_telp_perusahaan" => $data["nomor_telp_perusahaan"],
        ]);

        notify()->success('Berhasil memperbarui data profil', 'Notifikasi');

        return back();
    }
}
