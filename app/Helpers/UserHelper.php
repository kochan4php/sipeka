<?php

namespace App\Helpers;

use Illuminate\Http\RedirectResponse;

class UserHelper extends AuthHelper {
  public static function whoIsLoggedInNow(): string|RedirectResponse {
    return parent::whoIsLoggedInNow();
  }

  public static function getAdminData(): ?object {
    return self::whoIsLoggedInNow() === 'admin' ? parent::user()?->admin : null;
  }

  public static function getCompanyData(): ?object {
    return self::whoIsLoggedInNow() === 'perusahaan' ? parent::user()?->perusahaan : null;
  }

  public static function getAlumniData(): ?object {
    return self::whoIsLoggedInNow() === 'alumni' ? parent::user()?->pelamar?->alumni : null;
  }

  public static function getCandidateDataFromOutsideTheSchool(): ?object {
    return self::whoIsLoggedInNow() === 'kandidat-luar' ? parent::user()?->pelamar?->masyarakat : null;
  }
}
