<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LowonganKerja;

class LowonganKerjaController extends Controller
{
  public function __invoke(LowonganKerja $lowonganKerja)
  {
    return view('lowongan', compact('lowonganKerja'));
  }
}
