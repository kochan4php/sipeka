<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja;
use App\Models\MitraPerusahaan;

final class OuterController extends Controller {
  public function __invoke() {
    $lowongan = LowonganKerja::limit(10)->latest()->get();
    $perusahaan = MitraPerusahaan::limit(10)->get();

    return view('index', compact('lowongan', 'perusahaan'));
  }
}
