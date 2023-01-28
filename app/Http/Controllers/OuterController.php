<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja;
use App\Models\MitraPerusahaan;
use Illuminate\Contracts\View\View;

final class OuterController extends Controller {
  public function __invoke(): View {
    $lowongan = LowonganKerja::limit(10)->latest()->get();
    $perusahaan = MitraPerusahaan::limit(10)->get();

    return view('index', compact('lowongan', 'perusahaan'));
  }
}
