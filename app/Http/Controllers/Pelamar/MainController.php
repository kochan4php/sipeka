<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller {
	private function getApplicantData(): object {
		return (Auth::check() && Auth::user()->pelamar->alumni) ?
			Auth::user()->pelamar->alumni : Auth::user()->pelamar->masyarakat;
	}

	public function __invoke() {
		$data = $this->getApplicantData();
		return (Auth::check() && Auth::user()->pelamar->alumni) ?
			view('pelamar.profile_alumni', compact('data')) :
			view('pelamar.profile_kandidat_luar', compact('data'));
	}
}
