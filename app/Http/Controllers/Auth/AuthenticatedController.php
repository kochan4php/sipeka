<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class AuthenticatedController extends Controller {
  public function index(): View {
    return view('auth.login');
  }

  public function authenticate(Request $request): RedirectResponse {
    $request->validate(['username' => ['required'], 'password' => ['required']]);
    $credentials = $request->only(['username', 'password']);
    $remember = $request->has('remember') ? true : false;

    $fieldType = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    if (Auth::attempt([
      $fieldType => $credentials['username'],
      'password' => $credentials['password']
    ], $remember)) {
      $request->session()->regenerate();
      $role = Auth::user()->level_user->identifier;

      notify("Selamat datang kembali", "Notifikasi");

      switch ($role) {
        case 'admin':
          return to_route('admin.index');
          break;
        case 'perusahaan':
          return to_route('perusahaan.index');
          break;
        default:
          return to_route('home');
          break;
      }
    }

    return back()
      ->withErrors(['Username atau Email dan Password salah! Silahkan coba lagi.']);
  }
}
