<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Pengguna;

use App\Models\{LevelUser, User, MitraPerusahaan};
use App\Helpers\Helper;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreMitraPerusahaanRequest;
use App\Traits\HasCity;
use App\Traits\MitraHasCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\{ItemNotFoundException};
use Illuminate\Support\Facades\{DB, Hash};
use Spatie\QueryBuilder\QueryBuilder;

final class MitraPerusahaanController extends Controller {
    use HasMainRoute, HasCity, MitraHasCategory;

    public function __construct() {
        $this->setMainRoute('admin.perusahaan.index');
    }

    private function generatePerusahaanUsername(string $name): string {
        return Helper::generateUniqueUsername('PRSHN', 3, $name, false);
    }

    public function blockOneMitra(User $user): RedirectResponse {
        $perusahaan = $user->perusahaan;
        $perusahaan->update(['is_blocked' => true]);
        notify()->success("Berhasil memblokir {$perusahaan->nama_perusahaan}", 'Notifikasi');
        return back();
    }

    public function getAllMitraData(Request $request): View {
        $perusahaan = QueryBuilder::for(MitraPerusahaan::class)
            ->filter($request->q)
            ->nonBlocked()
            ->latest('id_perusahaan')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengguna.perusahaan.index', compact('perusahaan'));
    }

    public function createOneMitraData(): View {
        return view('admin.pengguna.perusahaan.tambah', [
            'kategori' => $this->kategori,
            'kota' => $this->city
        ]);
    }

    public function storeOneMitraData(StoreMitraPerusahaanRequest $request): RedirectResponse {
        $kantor = null;

        if ($request->has([
            'wilayah_kantor',
            'status_kantor',
            'no_telp_kantor',
            'alamat_kantor'
        ])) {
            // Validasi data kantor
            $request->validate([
                'wilayah_kantor' => ['required'],
                'status_kantor' => ['required'],
                'no_telp_kantor' => ['required'],
                'alamat_kantor' => ['required']
            ]);

            $kantor = $request->validatedDataKantor();
            $kantor['kantor_utama'] = true;
        }

        $mitra = $request->validatedDataPerusahaan();
        $mitra['username_perusahaan'] = $this->generatePerusahaanUsername($mitra['nama_perusahaan']);
        $mitra['password_perusahaan'] = Hash::make($mitra['password_perusahaan']);

        $level = LevelUser::firstWhere('identifier', 'perusahaan')->id_level;

        $insertUser = User::create([
            'id_level' => $level,
            'username' => $mitra['username_perusahaan'],
            'email' => $mitra['email_perusahaan'],
            'password' => $mitra['password_perusahaan']
        ]);

        $perusahaan = MitraPerusahaan::create([
            'id_user' => $insertUser->id_user,
            'nama_perusahaan' => $mitra['nama_perusahaan'],
            'nomor_telp_perusahaan' => $mitra['no_telepon_perusahaan'],
            'foto_sampul_perusahaan' => $mitra['foto_sampul_perusahaan'],
            'logo_perusahaan' => $mitra['logo_perusahaan'],
            'deskripsi_perusahaan' => $mitra['deskripsi_perusahaan'],
            'kategori_perusahaan' => $mitra['kategori_perusahaan']
        ]);

        if (!is_null($kantor)) $perusahaan->kantor()->create($kantor);

        notify()->success('Berhasil Menambahkan Data Mitra Perusahaan', 'Notifikasi');
        return $this->redirectToMainRoute();
    }

    public function getDetailOneMitraDataByUsername(User $user): View {
        $perusahaan = $user->perusahaan;
        return view('admin.pengguna.perusahaan.detail', compact('perusahaan', 'user'));
    }

    public function editOneMitraData(User $user): View {
        $perusahaan = $user->perusahaan;
        return view('admin.pengguna.perusahaan.sunting', [
            'perusahaan' => $perusahaan,
            'kategori' => $this->kategori,
            'kota' => $this->city,
            'user' => $user
        ]);
    }

    public function updateOneMitraData(StoreMitraPerusahaanRequest $request, User $user): RedirectResponse {
        $perusahaan = $user->perusahaan;
        $mitra = $request->validatedDataPerusahaan();

        if ($request->hasFile('foto_sampul_perusahaan') || $request->hasFile('logo_perusahaan')) {
            Helper::deleteMultipleFileIfExistsInStorageFolder(
                $perusahaan->foto_sampul_perusahaan,
                $perusahaan->logo_perusahaan
            );
        }

        if ($perusahaan->nama_perusahaan !== $mitra['nama_perusahaan']) {
            $mitra['new_username_perusahaan'] = $this->generatePerusahaanUsername($mitra['nama_perusahaan']);
            $user->update(['username' => $mitra['new_username_perusahaan']]);
        } else {
            $mitra['new_username_perusahaan'] = null;
        }

        if ($user->email !== $mitra['email_perusahaan']) {
            $user->update(['email' => $mitra['email_perusahaan']]);
        }

        $perusahaan->update([
            'nama_perusahaan' => $mitra['nama_perusahaan'],
            'nomor_telp_perusahaan' => $mitra['no_telepon_perusahaan'],
            'foto_sampul_perusahaan' => $mitra['foto_sampul_perusahaan'],
            'logo_perusahaan' => $mitra['logo_perusahaan'],
            'kategori_perusahaan' => $mitra['kategori_perusahaan'],
            'deskripsi_perusahaan' => $mitra['deskripsi_perusahaan']
        ]);

        notify()->success('Berhasil memperbarui data mitra', 'Notifikasi');
        return $this->redirectToMainRoute();
    }
}
