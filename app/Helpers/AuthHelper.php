<?php

namespace App\Helpers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthHelper {
  protected static function user(): ?Authenticatable {
    return Auth::check() ? Auth::user() : null;
  }

  protected static function whoIsLoggedInNow(): string|RedirectResponse {
    switch (!is_null(self::user())):
      case !is_null(self::user()?->admin):
        return 'admin';
        break;
      case !is_null(self::user()?->perusahaan):
        return 'perusahaan';
        break;
      case !is_null(self::user()?->pelamar):
        switch (self::user()?->pelamar):
          case !is_null(self::user()?->pelamar?->alumni):
            return 'alumni';
            break;
          case !is_null(self::user()?->pelamar?->masyarakat):
            return 'kandidat-luar';
            break;
        endswitch;
        break;
      default:
        return to_route('login');
        break;
    endswitch;
  }
}
