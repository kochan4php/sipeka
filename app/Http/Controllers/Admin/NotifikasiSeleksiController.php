<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\NotifikasiSeleksi;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class NotifikasiSeleksiController extends Controller {
	public function index(Pelamar $pelamar) {
		$notifikasiSeleksi = NotifikasiSeleksi::whereIdPelamar($pelamar->id_pelamar)->latest()->get();
		$dataPelamar = UserHelper::getApplicantData($pelamar);
		$urlPrev = URL::previous();

		return view('notifikasi.seleksi.index', compact('notifikasiSeleksi', 'dataPelamar', 'urlPrev'));
	}

	public function store(Request $request, Pelamar $pelamar) {
		$validatedData = $request->only('pesan');
		$pelamar->notifikasi_seleksi()->create($validatedData);
		$dataPelamar = UserHelper::getApplicantData($pelamar);

		return to_route('notifikasi.seleksi.index', $pelamar->id_pelamar)
			->with('sukses', "Berhasil menambahkan pemberitahuan untuk {$dataPelamar->nama_lengkap}");
	}

	public function destroy(Pelamar $pelamar, NotifikasiSeleksi $notifikasiSeleksi) {
		$notifikasiSeleksi->delete();
		return back()
			->with('sukses', "Berhasil menghapus pemberitahuan seleksi");
	}
}
