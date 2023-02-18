<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Pengguna;

use App\Helpers\Helper;
use App\Models\User;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreMitraPerusahaanRequest;
use App\Models\LevelUser;
use App\Models\MitraPerusahaan;
use App\Traits\HasCity;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\{Collection, ItemNotFoundException};
use Illuminate\Support\Facades\{DB, Hash};
use Spatie\QueryBuilder\QueryBuilder;

final class MitraPerusahaanController extends Controller {
    use HasMainRoute, HasCity;

    private $kategori = [
        'Akuntansi / Keuangan',
        'Sumber Daya Manusia',
        'Penjualan / Pemasaran',
        'Seni/Media/Komunikasi',
        'Pelayanan',
        'Hotel/Restoran',
        'Pendidikan/Pelatihan',
        'Komputer/Teknologi Informasi',
        'Teknik',
        'Manufaktur',
        'Bangunan/Konstruksi',
        'Sains',
        'Layanan Kesehatan',
        'Lainnya'
    ];

    public function __construct() {
        $this->setMainRoute('admin.perusahaan.index');
    }

    private function getOnePerusahaanByUsername(string $username): object {
        return collect(DB::select('CALL get_one_perusahaan_by_username(?)', [$username]))->firstOrFail();
    }

    private function generatePerusahaanUsername(string $name): string {
        return Helper::generateUniqueUsername('PRSHN', 5, $name);
    }

    public function blockOneMitra(User $user): RedirectResponse {
        $perusahaan = $user->perusahaan;
        $perusahaan->update(['is_blocked' => true]);
        notify()->success("Berhasil memblokir {$perusahaan->nama_perusahaan}", 'Notifikasi');
        return back();
    }

    public function unblockOneMitra(User $user): RedirectResponse {
        $perusahaan = $user->perusahaan;
        $perusahaan->update(['is_blocked' => false]);
        notify()->success("Berhasil membuka blokir {$perusahaan->nama_perusahaan}", 'Notifikasi');
        return back();
    }

    public function getAllMitraData(): View {
        $perusahaan = QueryBuilder::for(MitraPerusahaan::class)
            ->with('user')
            ->latest('id_perusahaan')
            ->where('is_blocked', false)
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
        try {
            $kantor = null;

            if ($request->has(['wilayah_kantor', 'status_kantor', 'no_telp_kantor', 'alamat_kantor'])) {
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

            if (!is_null($kantor)) {
                $perusahaan->kantor()->create($kantor);
            }

            notify()->success('Berhasil Menambahkan Data Mitra Perusahaan', 'Notifikasi');

            return $this->redirectToMainRoute();
        } catch (\Exception $e) {
            notify()->error($e->getMessage(), 'Notifikasi');

            return $this->redirectToMainRoute()->with('error', $e->getMessage());
        }
    }

    public function getDetailOneMitraDataByUsername(string $username): View|RedirectResponse {
        try {
            $perusahaan = $this->getOnePerusahaanByUsername($username);

            return view('admin.pengguna.perusahaan.detail', compact('perusahaan'));
        } catch (ItemNotFoundException) {
            notify()->error('Data perusahaan tidak ditemukan', 'Notifikasi');

            return $this->redirectToMainRoute();
        }
    }

    public function editOneMitraData(string $username): View|RedirectResponse {
        try {
            $perusahaan = $this->getOnePerusahaanByUsername($username);

            return view('admin.pengguna.perusahaan.sunting', [
                'perusahaan' => $perusahaan,
                'kategori' => $this->kategori,
                'kota' => $this->city
            ]);
        } catch (ItemNotFoundException) {
            notify()->error('Data perusahaan tidak ditemukan', 'Notifikasi');

            return $this->redirectToMainRoute();
        }
    }

    public function updateOneMitraData(StoreMitraPerusahaanRequest $request, string $username): RedirectResponse {
        try {
            $perusahaan = $this->getOnePerusahaanByUsername($username);
            $mitra = $request->validatedDataPerusahaan();

            if ($request->hasFile('foto_sampul_perusahaan') || $request->hasFile('logo_perusahaan')) {
                Helper::deleteMultipleFileIfExistsInStorageFolder(
                    $perusahaan->foto_sampul_perusahaan,
                    $perusahaan->logo_perusahaan
                );
            }

            if ($perusahaan->nama_perusahaan !== $mitra['nama_perusahaan']) {
                $mitra['new_username_perusahaan'] = $this->generatePerusahaanUsername($mitra['nama_perusahaan']);
            } else {
                $mitra['new_username_perusahaan'] = null;
            }

            DB::update(
                "CALL update_one_perusahaan_by_username(
        :old_username,
        :new_username_perusahaan,
        :email_perusahaan,
        :nama_perusahaan,
        :nomor_telp_perusahaan,
        :foto_sampul_perusahaan,
        :logo_perusahaan,
        :deskripsi_perusahaan,
        :jenis_perusahaan,
        :kategori_perusahaan)",
                [
                    'old_username' => $perusahaan->username,
                    'new_username_perusahaan' => $mitra['new_username_perusahaan'],
                    'email_perusahaan' => $mitra['email_perusahaan'],
                    'nama_perusahaan' => $mitra['nama_perusahaan'],
                    'nomor_telp_perusahaan' => $mitra['no_telepon_perusahaan'],
                    'foto_sampul_perusahaan' => $mitra['foto_sampul_perusahaan'],
                    'logo_perusahaan' => $mitra['logo_perusahaan'],
                    'deskripsi_perusahaan' => $mitra['deskripsi_perusahaan'],
                    'jenis_perusahaan' => $mitra['jenis_perusahaan'],
                    'kategori_perusahaan' => $mitra['kategori_perusahaan']
                ]
            );

            notify()->success('Berhasil memperbarui data mitra', 'Notifikasi');

            return $this->redirectToMainRoute();
        } catch (ItemNotFoundException) {
            notify()->error('Data mitra tidak ditemukan', 'Notifikasi');

            return $this->redirectToMainRoute();
        }
    }
}
