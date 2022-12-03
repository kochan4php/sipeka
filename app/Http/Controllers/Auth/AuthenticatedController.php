<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }

  public function authenticate(Request $request)
  {
    $request->validate(['username' => ['required'], 'password' => ['required']]);
    $credentials = $request->only(['username', 'password']);
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended(route('admin.index'));
    }
    return redirect()->back();
  }
}
