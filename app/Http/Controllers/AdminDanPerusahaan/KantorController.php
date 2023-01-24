<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Http\Controllers\Controller;
use App\Models\Kantor;
use App\Models\MitraPerusahaan;
use App\Traits\HasCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

final class KantorController extends Controller {
  use HasCity;

  public function getAllKantorData(string $username = null) {
    $dataMitra = null;
    $kantor = null;
    $namaPerusahaan = null;

    if (Gate::check('admin')) {
      $kantor = Kantor::with('perusahaan')->latest()->get();
      return view('kantor.index', compact('kantor', 'namaPerusahaan'));
    } else if (Gate::check('perusahaan')) {
      $dataMitra = Auth::user()->perusahaan;
      $kantor = $dataMitra->kantor;
      return view('kantor.index', compact('kantor', 'dataMitra'));
    }
  }

  public function getDetailOneKantorData(Kantor $kantor) {
    return view('kantor.detail', compact('kantor'));
  }

  public function createOneKantorData() {
    $mitra = MitraPerusahaan::all(['id_perusahaan', 'jenis_perusahaan', 'nama_perusahaan']);

    return view('kantor.tambah', [
      'kota' => $this->city,
      'mitra' => $mitra
    ]);
  }

  public function storeOneKantorData(Request $request) {
    //
  }

  public function editOneKantorData(Kantor $kantor) {
    return view('kantor.sunting', compact('kantor'));
  }

  public function updateOneKantorData(Request $request, Kantor $kantor) {
    //
  }

  public function deleteOneKantorData(Kantor $kantor) {
    //
  }
}
