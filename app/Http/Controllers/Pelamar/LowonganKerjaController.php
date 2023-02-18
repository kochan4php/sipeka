<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pelamar;

use App\Helpers\Helper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Models\LowonganKerja;
use App\Models\PendaftaranLowongan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class LowonganKerjaController extends Controller {
    public function show(LowonganKerja $lowonganKerja): View {
        $lowongan = LowonganKerja::where('slug', '!=', $lowonganKerja->slug)->inRandomOrder()->limit(10)->get();
        $registeredApplicantId = PendaftaranLowongan::firstWhere([
            'id_pelamar' => UserHelper::getApplicantData(Auth::user()->pelamar)->pelamar->id_pelamar,
            'id_lowongan' => $lowonganKerja->id_lowongan,
        ])?->id_pelamar;

        return view('lowongan', compact('lowonganKerja', 'lowongan', 'registeredApplicantId'));
    }

    public function applyJob(Request $request, LowonganKerja $lowonganKerja): RedirectResponse {
        $request->validate([
            'surat_lamaran_kerja' => ['required', 'mimes:pdf,doc,docx', 'max:5120'],
            'applicant_promotion' => ['nullable']
        ], [
            'surat_lamaran_kerja.required' => 'Surat lamaran kerja tidak boleh kosong!',
            'surat_lamaran_kerja.mimes' => 'Surat lamaran kerja harus berekstensi pdf, doc atau docx!',
            'surat_lamaran_kerja.max' => 'Surat lamaran kerja tidak boleh lebih dari 5MB!'
        ]);

        $data = $request->only('applicant_promotion');
        $id_pelamar = UserHelper::getApplicantData(Auth::user()->pelamar)->pelamar->id_pelamar;
        $id_lowongan = $lowonganKerja->id_lowongan;
        $kode_pendaftaran = Helper::generateUniqueCode('LMRN', length: 15);
        $surat_lamaran_kerja = $request->file('surat_lamaran_kerja')->store('lamarankerja');
        $applicant_promotion = $data['applicant_promotion'];

        $validatedData = compact(
            'id_pelamar',
            'id_lowongan',
            'kode_pendaftaran',
            'surat_lamaran_kerja',
            'applicant_promotion'
        );

        PendaftaranLowongan::create($validatedData);
        notify()->success("Berhasil mendaftar di lowongan {$lowonganKerja->judul_lowongan}", 'Notifikasi');

        return back();
    }
}
