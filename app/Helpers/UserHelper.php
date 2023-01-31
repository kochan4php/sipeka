<?php

namespace App\Helpers;

use App\Models\Pelamar;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserHelper {
  public static function getApplicantName(Pelamar $pelamar): string {
    return $pelamar->alumni ? $pelamar->alumni->nama_lengkap : $pelamar->masyarakat->nama_lengkap;
  }

  public static function getAdminData(): ?object {
    return (Auth::check() && !is_null(Auth::user()->admin)) ? Auth::user()->admin : null;
  }

  public static function getCompanyData(User $user): object {
    return $user->perusahaan;
  }

  public static function getApplicantData(Pelamar $pelamar): object {
    return $pelamar->alumni ? $pelamar->alumni : $pelamar->masyarakat;
  }
}
