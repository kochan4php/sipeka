<?php

namespace App\Helpers;

use Illuminate\Http\RedirectResponse;

class UserHelper extends AuthHelper
{
  public static function whoIsLoggedInNow(): string|RedirectResponse
  {
    return parent::whoIsLoggedInNow();
  }

  public static function ifTheCurrentlyLoggedInUserIsAdmin(): bool
  {
    return self::whoIsLoggedInNow() === 'admin';
  }

  public static function ifTheCurrentlyLoggedInUserIsCompany(): bool
  {
    return self::whoIsLoggedInNow() === 'perusahaan';
  }

  public static function ifTheCurrentlyLoggedInUserIsAlumni(): bool
  {
    return self::whoIsLoggedInNow() === 'alumni';
  }

  public static function ifTheCurrentlyLoggedInUserIsCandidate(): bool
  {
    return self::whoIsLoggedInNow() === 'kandidat-luar';
  }

  public static function getAdminData(): ?object
  {
    return self::ifTheCurrentlyLoggedInUserIsAdmin() ? parent::user()->admin : null;
  }

  public static function getCompanyData(): ?object
  {
    return self::ifTheCurrentlyLoggedInUserIsCompany() ? parent::user()->perusahaan : null;
  }

  public static function getAlumniData(): ?object
  {
    return self::ifTheCurrentlyLoggedInUserIsAlumni() ? parent::user()->pelamar->alumni : null;
  }

  public static function getCandidateDataFromOutsideTheSchool(): ?object
  {
    return self::ifTheCurrentlyLoggedInUserIsCandidate() ? parent::user()->pelamar->masyarakat : null;
  }
}
