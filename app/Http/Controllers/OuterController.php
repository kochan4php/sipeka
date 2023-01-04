<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja;
use App\Models\MitraPerusahaan;

class OuterController extends Controller {
  public function __invoke() {
    $lowongan = LowonganKerja::all();
    $perusahaan = MitraPerusahaan::all();
    return view('index', compact('lowongan', 'perusahaan'));
  }
}
