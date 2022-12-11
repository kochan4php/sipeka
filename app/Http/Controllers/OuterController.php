<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja;

class OuterController extends Controller
{
  public function __invoke()
  {
    $lowongan = LowonganKerja::all();
    return view('index', compact('lowongan'));
  }
}
