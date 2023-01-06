<?php

namespace App\Helpers;

use App\Models\Pelamar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserHelper extends AuthHelper {
  public static function whoIsLoggedInNow(): string|RedirectResponse {
    return parent::whoIsLoggedInNow();
  }

  public static function getApplicantName(Pelamar $pelamar): string {
    return $pelamar->alumni ? $pelamar->alumni->nama_lengkap : $pelamar->masyarakat->nama_lengkap;
  }

  public static function getAdminData(): ?object {
    return (Auth::check() && is_null(Auth::user()?->perusahaan) && is_null(Auth::user()?->pelamar) && !is_null(Auth::user()?->admin))
      ? Auth::user()?->admin : null;
  }

  public static function getCompanyData(): ?object {
    return (Auth::check() && is_null(Auth::user()?->admin) && is_null(Auth::user()?->pelamar) && !is_null(Auth::user()?->perusahaan))
      ? parent::user()?->perusahaan : null;
  }

  public static function getAlumniData(): ?object {
    return self::whoIsLoggedInNow() === 'alumni' ? parent::user()?->pelamar?->alumni : null;
  }

  public static function getCandidateDataFromOutsideTheSchool(): ?object {
    return self::whoIsLoggedInNow() === 'kandidat-luar' ? parent::user()?->pelamar?->masyarakat : null;
  }
}
