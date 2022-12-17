<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\LowonganKerja;

class LowonganKerjaController extends Controller
{
  public function __invoke(LowonganKerja $lowonganKerja)
  {
    $lowongan = LowonganKerja::where('slug', '!=', $lowonganKerja->slug)->inRandomOrder()->limit(10)->get();
    return view('lowongan', compact('lowonganKerja', 'lowongan'));
  }
}
