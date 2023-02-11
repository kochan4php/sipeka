<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\GelarPendidikan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class PendidikanController extends Controller {
  public function index(): View {
    $pendidikan = Auth::user()->pelamar->riwayat_pendidikan;

    return view('pelamar.pendidikan.index', compact('pendidikan'));
  }

  public function create(): View {
    $kualifikasi = GelarPendidikan::all();

    return view('pelamar.pendidikan.tambah', compact('kualifikasi'));
  }

  public function store(Request $request, string $username): RedirectResponse {
    try {
      $validatedData = $request->only(['institut_or_universitas', 'kualifikasi', 'informasi_tambahan']);
      $validatedData['tahun_kelulusan'] = implode(' ', $request->only('bulan', 'tahun'));

      Auth::user()->pelamar->riwayat_pendidikan()->create($validatedData);

      return to_route('pelamar.pendidikan.index', $username)
        ->with('sukses', 'Berhasil menambahkan riwayat pendidikan baru');
    } catch (\Exception $e) {
      return to_route('pelamar.pendidikan.index', $username)
        ->with('error', $e->getMessage());
    }
  }
}
