<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\StoreTahapanSeleksiRequest;
use App\Models\{LowonganKerja, PendaftaranLowongan, TahapanSeleksi};
use Illuminate\Support\Facades\Gate;

class TahapanSeleksiController extends Controller {
  private string $tahapanSeleksiMainRoute = 'tahapan.seleksi.jobApplicationDetails';

  private function checkIfThisJobApplicationComesFromAVacancyFromACompanyThatIsCurrentlyLoggedInNow(
    PendaftaranLowongan $pendaftaranLowongan,
    string $message
  ): void {
    if ((Gate::check('perusahaan'))) :
      if (($pendaftaranLowongan->lowongan->perusahaan->id_perusahaan !== UserHelper::getCompanyData()->id_perusahaan)) :
        abort(403, $message);
      endif;
    endif;
  }

  private function getApplicantName(PendaftaranLowongan $pendaftaranLowongan): string {
    $pelamar = $pendaftaranLowongan->pelamar;
    return $pelamar->alumni ? $pelamar->alumni->nama_lengkap : $pelamar->masyarakat->nama_lengkap;
  }

  public function index() {
    $lamaranKerja = null;

    if (Gate::check('admin')) {
      $lamaranKerja = PendaftaranLowongan::with(['pelamar', 'lowongan'])->get()->load('tahapan_seleksi');
    } else if (Gate::check('perusahaan')) {
      $perusahaan = UserHelper::getCompanyData();
      $beberapaIdLowogan = LowonganKerja::whereIdPerusahaan($perusahaan->id_perusahaan)->get()->pluck('id_lowongan');
      $lamaranKerja = PendaftaranLowongan::with(['pelamar', 'lowongan'])
        ->select()
        ->whereIn('id_lowongan', $beberapaIdLowogan)
        ->get();
    }

    return view('seleksi.tahapan.index', compact('lamaranKerja'));
  }

  public function create(PendaftaranLowongan $pendaftaranLowongan) {
    $message = 'Kamu tidak bisa membuat tahapan seleksi baru dari lamaran kerja yang berasal dari lowongan kerja yang bukan milikmu.';
    $this->checkIfThisJobApplicationComesFromAVacancyFromACompanyThatIsCurrentlyLoggedInNow($pendaftaranLowongan, $message);

    $urutanTahapanTerakhir = $pendaftaranLowongan->tahapan_seleksi()->max('urutan_tahapan_ke') + 1;
    return view('seleksi.tahapan.create', compact('pendaftaranLowongan', 'urutanTahapanTerakhir'));
  }

  public function store(StoreTahapanSeleksiRequest $request, PendaftaranLowongan $pendaftaranLowongan) {
    try {
      $message = 'Kamu tidak bisa menambahkan tahapan seleksi baru dari lamaran kerja yang berasal dari lowongan kerja yang bukan milikmu.';
      $this->checkIfThisJobApplicationComesFromAVacancyFromACompanyThatIsCurrentlyLoggedInNow($pendaftaranLowongan, $message);

      $validatedData = $request->validatedData();
      $pendaftaranLowongan->tahapan_seleksi()->create($validatedData);
      $namaPelamar = $this->getApplicantName($pendaftaranLowongan);

      $successMsg = "Berhasil menambahkan tahapan seleksi baru untuk {$namaPelamar}";
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $pendaftaranLowongan->id_pendaftaran
      )->with('sukses', $successMsg);
    } catch (\Exception $e) {
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $pendaftaranLowongan->id_pendaftaran
      )->with('error', $e->getMessage());
    }
  }

  public function jobApplicationDetails(PendaftaranLowongan $pendaftaranLowongan) {
    $message = 'Kamu tidak bisa melihat detail dari lamaran kerja yang berasal dari lowongan kerja yang bukan milikmu.';
    $this->checkIfThisJobApplicationComesFromAVacancyFromACompanyThatIsCurrentlyLoggedInNow($pendaftaranLowongan, $message);

    return view('seleksi.tahapan.job_application_details', compact('pendaftaranLowongan'));
  }

  public function edit(PendaftaranLowongan $pendaftaranLowongan, TahapanSeleksi $tahapanSeleksi) {
    $message = 'Kamu tidak bisa mengedit tahapan seleksi dari lamaran kerja yang berasal dari lowongan kerja yang bukan milikmu.';
    $this->checkIfThisJobApplicationComesFromAVacancyFromACompanyThatIsCurrentlyLoggedInNow($pendaftaranLowongan, $message);

    return view('seleksi.tahapan.edit', compact('pendaftaranLowongan', 'tahapanSeleksi'));
  }

  public function update(StoreTahapanSeleksiRequest $request, PendaftaranLowongan $pendaftaranLowongan, TahapanSeleksi $tahapanSeleksi) {
    try {
      $message = 'Kamu tidak bisa memperbarui tahapan seleksi dari lamaran kerja yang berasal dari lowongan kerja yang bukan milikmu.';
      $this->checkIfThisJobApplicationComesFromAVacancyFromACompanyThatIsCurrentlyLoggedInNow($pendaftaranLowongan, $message);

      $validatedData = $request->validatedData();
      $pendaftaranLowongan->tahapan_seleksi()->firstWhere('id_tahapan', $tahapanSeleksi->id_tahapan)->update($validatedData);
      $namaPelamar = $this->getApplicantName($pendaftaranLowongan);

      $successMsg = "Berhasil memperbarui tahapan seleksi baru untuk {$namaPelamar}";
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $pendaftaranLowongan->id_pendaftaran
      )->with('sukses', $successMsg);
    } catch (\Exception $e) {
      return to_route(
        $this->tahapanSeleksiMainRoute,
        $pendaftaranLowongan->id_pendaftaran
      )->with('error', $e->getMessage());
    }
  }

  public function destroy(PendaftaranLowongan $pendaftaranLowongan, TahapanSeleksi $tahapanSeleksi) {
    try {
      $message = 'Kamu tidak bisa menghapus tahapan seleksi dari lamaran kerja yang berasal dari lowongan kerja yang bukan milikmu.';
      $this->checkIfThisJobApplicationComesFromAVacancyFromACompanyThatIsCurrentlyLoggedInNow($pendaftaranLowongan, $message);

      $pendaftaranLowongan->tahapan_seleksi()->firstWhere('id_tahapan', $tahapanSeleksi->id_tahapan)->delete();
      $namaPelamar = $this->getApplicantName($pendaftaranLowongan);

      $successMsg = "Berhasil menghapus tahapan seleksi untuk {$namaPelamar}";
      return back()->with('sukses', $successMsg);
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
