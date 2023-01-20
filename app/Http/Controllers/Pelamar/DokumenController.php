<?php

namespace App\Http\Controllers\Pelamar;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokumenController extends Controller {
	public function index() {
		$dokumen = Auth::user()->pelamar->dokumen;
		$jenisDokumen = Dokumen::all();

		return view('pelamar.dokumen', compact('dokumen', 'jenisDokumen'));
	}

	public function store(Request $request, User $username, Dokumen $dokumen) {
		try {
			$existsDocument = Auth::user()
				->pelamar
				->dokumen
				->firstWhere('id_jenis_dokumen', $dokumen->id_jenis_dokumen);

			if ($request->hasFile('file')) {
				if ($existsDocument?->nama_file) {
					Helper::deleteFileIfExistsInStorageFolder($existsDocument?->nama_file);
					$existsDocument->delete();
				}

				Auth::user()->pelamar->dokumen()->create([
					'id_jenis_dokumen' => $dokumen->id_jenis_dokumen,
					'nama_file' => $request->file('file')->store('pelamar/dokumen')
				]);
			}

			return to_route('pelamar.dokumen', $username)
				->with('sukses', "Berhasil mengupload file {$dokumen->nama_dokumen}");
		} catch (\Exception $e) {
			return to_route('pelamar.dokumen', $username)
				->with('error', $e->getMessage());
		}
	}
}
