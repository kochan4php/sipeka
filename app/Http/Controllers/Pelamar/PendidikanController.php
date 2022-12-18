<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendidikanController extends Controller
{
  public function index()
  {
    $pendidikan = Auth::user()->pelamar->riwayat_pendidikan;
    return view('pelamar.pendidikan.index', compact('pendidikan'));
  }
}
