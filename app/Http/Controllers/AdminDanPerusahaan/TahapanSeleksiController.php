<?php

declare(strict_types=1);

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\Tahapan\StoreTahapanSeleksiRequest;
use App\Models\{LowonganKerja, TahapanSeleksi};
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Gate};

final class TahapanSeleksiController extends Controller {
    private string $tahapanSeleksiMainRoute = 'tahapan.seleksi.detail_lowongan';

    public function createOneStagesOfSelection(LowonganKerja $lowonganKerja): View {
        $urutanTahapanTerakhir = $lowonganKerja->tahapan_seleksi()->max('urutan_tahapan_ke') + 1;
        return view('seleksi.tahapan.create', compact('lowonganKerja', 'urutanTahapanTerakhir'));
    }

    public function storeOneStagesOfSelection(
        StoreTahapanSeleksiRequest $request,
        LowonganKerja $lowonganKerja
    ): RedirectResponse {
        try {
            $validatedData = $request->validatedData();
            $lowonganKerja->tahapan_seleksi()->create($validatedData);
            $successMessage = "Berhasil menambahkan tahapan seleksi baru untuk lowongan {$lowonganKerja->judul_lowongan}";

            if (Gate::check('admin')) {
                $successMessage .=  " dari perusahaan {$lowonganKerja->perusahaan->nama_perusahaan}";
            }

            return to_route($this->tahapanSeleksiMainRoute, $lowonganKerja->slug)
                ->with('sukses', $successMessage);
        } catch (\Exception $e) {
            return to_route($this->tahapanSeleksiMainRoute, $lowonganKerja->slug)
                ->with('error', $e->getMessage());
        }
    }

    public function jobVacancyDetail(LowonganKerja $lowonganKerja): View {
        return view('seleksi.tahapan.job_detail', compact('lowonganKerja'));
    }

    public function editOneStagesOfSelection(LowonganKerja $lowonganKerja, TahapanSeleksi $tahapanSeleksi): View {
        return view('seleksi.tahapan.edit', compact('lowonganKerja', 'tahapanSeleksi'));
    }

    public function updateOneStagesOfSelection(
        StoreTahapanSeleksiRequest $request,
        LowonganKerja $lowonganKerja,
        TahapanSeleksi $tahapanSeleksi
    ): RedirectResponse {
        try {
            $validatedData = $request->validatedData();
            $existsUrutanTahapan = $lowonganKerja
                ->tahapan_seleksi
                ->firstWhere('urutan_tahapan_ke', $validatedData['urutan_tahapan_ke']);

            if (
                !is_null($existsUrutanTahapan?->urutan_tahapan_ke) &&
                $existsUrutanTahapan?->id_tahapan !== $tahapanSeleksi->id_tahapan
            ) {
                if ((int) $validatedData['urutan_tahapan_ke'] === $existsUrutanTahapan->urutan_tahapan_ke) {
                    return back()->with('error', "Urutan tahapan ke-{$existsUrutanTahapan->urutan_tahapan_ke} sudah ada.");
                };
            }

            $lowonganKerja->tahapan_seleksi()->firstWhere('id_tahapan', $tahapanSeleksi->id_tahapan)->update($validatedData);
            $successMessage = "Berhasil memperbarui tahapan seleksi untuk lowongan {$lowonganKerja->judul_lowongan}";

            if (Gate::check('admin')) {
                $successMessage .=  " dari perusahaan {$lowonganKerja->perusahaan->nama_perusahaan}";
            }

            return to_route($this->tahapanSeleksiMainRoute, $lowonganKerja->slug)
                ->with('sukses', $successMessage);
        } catch (\Exception $e) {
            return to_route($this->tahapanSeleksiMainRoute, $lowonganKerja->slug)
                ->with('error', $e->getMessage());
        }
    }

    public function selectionProcessThatRequiresApproval(): View {
        $tahapan = TahapanSeleksi::needApprove()->paginate(10);
        return view('seleksi.tahapan.need-approve', compact('tahapan'));
    }

    public function verifiedSelectionStages(Request $request, TahapanSeleksi $tahapanSeleksi): RedirectResponse {
        $fullUrl = explode('/', $request->fullUrl());
        $getLastPath = end($fullUrl);
        $attrTahapanSeleksi = [];

        if ($getLastPath === 'approve') {
            $attrTahapanSeleksi['status'] = 'Selesai';

            if (count($tahapanSeleksi->penilaian_seleksi()->notPassSelectionStage()->get()) !== 0) {
                foreach ($tahapanSeleksi->penilaian_seleksi()->notPassSelectionStage()->get() as $item) {
                    $item->pendaftaran()->update(['status_seleksi' => 'Tidak']);
                }
            }

            if (is_null(
                $tahapanSeleksi
                    ->where('id_lowongan', $tahapanSeleksi->lowongan->id_lowongan)
                    ->where('urutan_tahapan_ke', $tahapanSeleksi->urutan_tahapan_ke + 1)->first()
            )) {
                $tahapanSeleksi->lowongan()->update([
                    'active' => false,
                    'is_finished' => true
                ]);

                if (count($tahapanSeleksi->penilaian_seleksi()->passSelectionStage()->get()) !== 0) {
                    foreach ($tahapanSeleksi->penilaian_seleksi()->passSelectionStage()->get() as $item) {
                        $item->pendaftaran()->update(['status_seleksi' => 'Lulus']);
                    }
                }
            }
        } else if ($getLastPath === 'reject') {
            $attrTahapanSeleksi['status'] = 'Ditolak';
        }

        $tahapanSeleksi->update($attrTahapanSeleksi);

        $successMsg = "Berhasil memverifikasi seleksi {$tahapanSeleksi->judul_tahapan} dari perusahaan {$tahapanSeleksi->lowongan->perusahaan->nama_perusahaan}.";
        notify()->success($successMsg, 'Notifikasi');

        return back();
    }
}
