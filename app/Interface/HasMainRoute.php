<?php

namespace App\Interface;

use Illuminate\Http\RedirectResponse;

interface HasMainRoute
{
  public function redirectToMainRoute(): RedirectResponse;
}
