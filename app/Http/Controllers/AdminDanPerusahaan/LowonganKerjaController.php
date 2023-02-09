<?php

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Helpers\Helper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDanPerusahaan\StoreLowonganKerjaRequest;
use App\Models\{JenisPekerjaan, LowonganKerja, MitraPerusahaan, PendaftaranLowongan};
use App\Traits\HasMainRoute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Gate};
use Illuminate\Support\ItemNotFoundException;
use Spatie\QueryBuilder\QueryBuilder;

final class LowonganKerjaController extends Controller {
  use HasMainRoute;

  public function __construct() {
    $this->setMainRoute('lowongankerja.index');
  }

  public function getKantorJSONFormat(MitraPerusahaan $mitra): JsonResponse {
    return new JsonResponse($mitra->kantor);
  }

  public function getAllJobVacanciesData(): View {
    $lowongan = null;
    $lowonganNeedApprove = null;
    $pendaftaranLowongan = null;

    if (Gate::check('admin')) {
      $pendaftaranLowongan = PendaftaranLowongan::count();
      $lowonganNeedApprove = LowonganKerja::whereNull('is_approve')->count();
      $lowongan = QueryBuilder::for(LowonganKerja::class)
        ->with('perusahaan')
        ->where('is_approve', true)
        ->where('active', true)
        ->paginate(10)
        ->withQueryString();
    } else if (Gate::check('perusahaan')) {
      $pendaftaranLowongan = Auth::user()->perusahaan->pendaftaran_lowongan->count();
      $lowongan = Auth::user()
        ->perusahaan
        ->lowongan()
        ->where('is_approve', true)
        ->where('active', true)
        ->paginate(10)
        ->withQueryString();
    }

    return view('lowongankerja.index', compact('lowongan', 'pendaftaranLowongan', 'lowonganNeedApprove'));
  }

  public function createOneJobVacancyData(): View {
    $perusahaan = null;
    $jenisPekerjaan = JenisPekerjaan::all();

    if (Gate::check('admin')) {
      $perusahaan = MitraPerusahaan::all();
    }

    return view('lowongankerja.tambah', compact('perusahaan', 'jenisPekerjaan'));
  }

  public function storeOneJobVacancyData(StoreLowonganKerjaRequest $request): RedirectResponse {
    try {
      $validatedData = $request->validatedData();
      $validatedData['slug'] = Helper::generateUniqueSlug($validatedData['judul_lowongan']);

      if ($request->hasFile('banner')) {
        $validatedData['banner'] = $request->file('banner')->store('lowongan');
      }

      if (Gate::check('perusahaan')) {
        Auth::user()->perusahaan->lowongan()->create($validatedData);
      } else if (Gate::check('admin')) {
        $validatedData['id_perusahaan'] = collect($request->only('id_perusahaan'))->first();
        $validatedData['is_approve'] = true;
        $validatedData['active'] = true;

        LowonganKerja::create($validatedData);
      }

      notify()->success('Berhasil menambahkan data Lowongan baru.', 'Notifikasi');

      return $this->redirectToMainRoute();
    } catch (\Exception $e) {
      notify()->error($e->getMessage(), 'Notifikasi');

      return $this->redirectToMainRoute();
    }
  }

  public function jobVacanciesThatRequireApproval(Request $request): View {
    $lowongan = LowonganKerja::with(['perusahaan'])
      ->where('is_approve', null)
      ->get([
        'id_perusahaan',
        'id_jenis_pekerjaan',
        'judul_lowongan',
        'posisi',
        'active',
        'slug',
      ]);

    return view('lowongankerja.jobVacanciesThatRequireApproval', compact('lowongan'));
  }

  public function approveJobVacancies(LowonganKerja $lowonganKerja): RedirectResponse {
    $lowonganKerja->update(['is_approve' => true]);

    notify()->success("Berhasil mensetujui lowongan {$lowonganKerja->judul_lowongan}", 'Notifikasi');

    return to_route('lowongankerja.index');
  }

  public function rejectJobVacancies(LowonganKerja $lowonganKerja): RedirectResponse {
    $lowonganKerja->update(['is_approve' => false]);

    notify()->success("Berhasil menolak lowongan {$lowonganKerja->judul_lowongan}", 'Notifikasi');

    return to_route('lowongankerja.index');
  }

  public function getDetailOneJobVacancyData(LowonganKerja $lowonganKerja): View|RedirectResponse {
    try {
      return view('lowongankerja.detail', compact('lowonganKerja'));
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }

  public function editOneJobVacancyData(LowonganKerja $lowonganKerja): View|RedirectResponse {
    try {
      $lowongan = null;
      $perusahaan = null;
      $jenisPekerjaan = JenisPekerjaan::all();

      if (Gate::check('perusahaan')) {
        $lowongan = Auth::user()->perusahaan->lowongan->firstWhere('id_lowongan', $lowonganKerja->id_lowongan);
      } else if (Gate::check('admin')) {
        $lowongan = $lowonganKerja;
        $perusahaan = MitraPerusahaan::all();
      }

      return view('lowongankerja.sunting', compact('lowongan', 'perusahaan', 'jenisPekerjaan'));
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }

  public function updateOneJobVacancyData(
    StoreLowonganKerjaRequest $request,
    LowonganKerja $lowonganKerja
  ): RedirectResponse {
    try {
      $validatedData = $request->validatedData();

      if ($validatedData['judul_lowongan'] !== $lowonganKerja->judul_lowongan) {
        $validatedData['slug'] = Helper::generateUniqueSlug($validatedData['judul_lowongan']);
      }

      if ($request->hasFile('banner')) {
        $validatedData['banner'] = $request->file('banner')->store('lowongan');
        Helper::deleteFileIfExistsInStorageFolder($lowonganKerja->banner);
      }

      if (Gate::check('perusahaan')) {
        Auth::user()->perusahaan->lowongan()->firstWhere('slug', $lowonganKerja->slug)->update($validatedData);
      } else if (Gate::check('admin')) {
        $validatedData['id_perusahaan'] = $lowonganKerja->perusahaan->id_perusahaan;
        $lowonganKerja->update($validatedData);
      }

      return $this->redirectToMainRoute()->with('sukses', 'Berhasil menambahkan data Lowongan baru.');
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data lowongan kerja tidak ditemukan');
    }
  }

  public function deactiveOneJobVacancy(LowonganKerja $lowonganKerja): RedirectResponse {
    try {
      $lowonganKerja->update(['active' => false]);
      notify()->success('Berhasil menonaktifkan lowongan', 'Notifikasi');
      return back();
    } catch (\Exception $e) {
      notify()->success($e->getMessage(), 'Notifikasi');
      return back();
    }
  }
}
