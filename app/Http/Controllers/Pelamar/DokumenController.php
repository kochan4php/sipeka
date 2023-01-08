<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokumenController extends Controller {
	public function index() {
		$dokumen = Auth::user()->pelamar->dokumen;
		$jenisDokumen = Dokumen::all();
		return view('pelamar.dokumen', compact('dokumen', 'jenisDokumen'));
	}
}
