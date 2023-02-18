<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Angkatan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\Session;
use Spatie\QueryBuilder\QueryBuilder;

final class AngkatanController extends Controller {
    public function getAllAngkatanData(): View {
        $angkatan = QueryBuilder::for(Angkatan::class)
            ->latest('id_angkatan')
            ->paginate(10);

        return view('admin.masterdata.angkatan.index', compact('angkatan'));
    }

    public function storeOneAngkatanData(Request $request): RedirectResponse {
        try {
            $request->validate(['id_angkatan' => ['required'], 'angkatan_tahun' => ['required']]);
            $validatedData = $request->only(['id_angkatan', 'angkatan_tahun']);

            Angkatan::create($validatedData);
            Session::flash('sukses', 'Berhasil menambahkan data Angkatan Baru');

            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getOneDetailAngkatanData(Angkatan $angkatan): JsonResponse|RedirectResponse {
        try {
            return response()->json($angkatan);
        } catch (\Exception $e) {
            return back()->with('error', 'Data jenis dokumen tidak ditemukan');
        }
    }

    public function updateOneAngkatanData(Request $request, Angkatan $angkatan): RedirectResponse {
        try {
            $request->validate(['id_angkatan' => ['required'], 'angkatan_tahun' => ['required']]);
            $validatedData = $request->only(['id_angkatan', 'angkatan_tahun']);

            $angkatan->update($validatedData);
            Session::flash('sukses', 'berhasil memperbarui data angkatan');

            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
