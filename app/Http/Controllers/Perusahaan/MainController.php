<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke()
  {
    $jumlah_alumni = collect(DB::select("SELECT * FROM jumlah_alumni"))
      ->firstOrFail()
      ->jumlah_alumni;

    return view('perusahaan.index', compact('jumlah_alumni'));
  }
}
