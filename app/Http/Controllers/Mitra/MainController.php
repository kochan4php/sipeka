<?php

declare(strict_types=1);

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class MainController extends Controller {
    public function __invoke(): View {
        $jumlah_lowongan = Auth::user()->perusahaan->lowongan->count();
        $jumlah_kantor = Auth::user()->perusahaan->kantor->count();
        $jumlah_alumni = collect(DB::select("SELECT * FROM jumlah_alumni"))
            ->firstOrFail()
            ->jumlah_alumni;

        return view('perusahaan.index', compact('jumlah_alumni', 'jumlah_lowongan', 'jumlah_kantor'));
    }
}
