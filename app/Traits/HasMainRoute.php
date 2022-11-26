<?php

namespace App\Traits;

use Illuminate\Http\RedirectResponse;

trait HasMainRoute
{
  private string $mainRoute;

  private function setMainRoute(string $namedRoute): void
  {
    $this->mainRoute = $namedRoute;
  }

  private function redirectToMainRoute(): RedirectResponse
  {
    return redirect()->route($this->mainRoute);
  }
}
