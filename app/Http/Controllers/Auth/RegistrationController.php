<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class RegistrationController extends Controller
{
  public function index(): View|Factory
  {
    return view('auth.register');
  }

  public function register(): RedirectResponse|Redirector
  {
    //
  }
}
