<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Models\User;
use Illuminate\Contracts\View\View;

final class PelamarController extends Controller {
  public function index(): View {
    $pelamar = Pelamar::all();

    return view('perusahaan.pelamar.index', compact('pelamar'));
  }

  public function show(User $user): View {
    return !is_null($user->pelamar->alumni) ?
      view('perusahaan.pelamar.alumni', ['alumni' => $user->pelamar->alumni]) :
      view('perusahaan.pelamar.kandidat_luar', ['kandidat_luar' => $user->pelamar->masyarakat]);
  }
}
