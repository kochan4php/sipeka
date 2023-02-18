<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Pengguna;

use App\Models\User;
use App\Models\SiswaAlumni;
use App\Helpers\Helper;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreAlumniRequest;
use App\Models\LevelUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Hash};
use Illuminate\Support\{Collection, ItemNotFoundException};
use Spatie\QueryBuilder\QueryBuilder;

final class AlumniController extends Controller {
    use HasMainRoute;

    public function __construct() {
        $this->setMainRoute('admin.alumni.index');
    }

    private function getJurusan(): Collection {
        return collect(DB::select('SELECT * FROM jurusan'));
    }

    private function getAngkatan(): Collection {
        return collect(DB::select('SELECT * FROM angkatan'));
    }

    public function getAllAlumniData(Request $request): View {
        $alumni = [];

        if ($request->has('q')) {
            $alumni = SiswaAlumni::with(['jurusan', 'angkatan', 'pelamar'])
                ->filter($request->input('q'))
                ->latest('id_angkatan')
                ->paginate(10)
                ->withQueryString();
        } else {
            $alumni = SiswaAlumni::with(['jurusan', 'angkatan', 'pelamar'])
                ->latest('id_angkatan')
                ->paginate(10)
                ->withQueryString();
        }

        return view('admin.pengguna.alumni.index', compact('alumni'));
    }

    public function createOneAlumniData(): View {
        $jurusan = $this->getJurusan();
        $angkatan = $this->getAngkatan();
        return view('admin.pengguna.alumni.tambah', compact('jurusan', 'angkatan'));
    }

    public function storeOneAlumniData(StoreAlumniRequest $request): RedirectResponse {
        try {
            $validatedData = $request->validatedDataAlumni();
            $validatedData['username'] = $validatedData['nis'];
            $validatedData['password'] = Hash::make($validatedData['nis']);
            $level = LevelUser::firstWhere('identifier', 'pelamar');

            $dataUser = [
                'id_level' => $level->id_level,
                'username' => $validatedData['username'],
                'password' => $validatedData['password'],
            ];

            $dataAlumni = [
                'id_angkatan' => $validatedData['angkatan'],
                'id_jurusan' => $validatedData['jurusan'],
                'nis' => $validatedData['nis'],
                'nama_lengkap' => $validatedData['nama'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'no_telepon' => $validatedData['no_telp'],
                'alamat_tempat_tinggal' => $validatedData['alamat_alumni'],
                'foto' => $validatedData['foto_alumni'],
            ];

            User::create($dataUser)
                ->pelamar()
                ->create()
                ->alumni()
                ->create($dataAlumni);

            notify()->success('Berhasil Menambahkan Data Alumni', 'Notifikasi');

            return $this->redirectToMainRoute();
        } catch (\Exception $e) {
            notify()->error($e->getMessage(), 'Notifikasi');

            return $this->redirectToMainRoute();
        }
    }

    public function getDetailOneAlumniDataByNIS(User $user): View|RedirectResponse {
        try {
            $alumni = $user->alumni;

            return view('admin.pengguna.alumni.detail', compact('alumni', 'user'));
        } catch (ItemNotFoundException) {
            notify()->error('Data alumni tidak ditemukan', 'Notifikasi');

            return $this->redirectToMainRoute();
        }
    }

    public function editOneAlumniData(User $user): View|RedirectResponse {
        try {
            $jurusan = $this->getJurusan();
            $angkatan = $this->getAngkatan();
            $alumni = $user->alumni;

            return view('admin.pengguna.alumni.sunting', compact('jurusan', 'angkatan', 'alumni', 'user'));
        } catch (ItemNotFoundException) {
            notify()->error('Data alumni tidak ditemukan', 'Notifikasi');

            return $this->redirectToMainRoute()->with('error', 'Data alumni tidak ditemukan');
        }
    }

    public function updateOneAlumniData(StoreAlumniRequest $request, User $user): RedirectResponse {
        try {
            $validatedData = $request->validatedDataAlumni();
            $alumni = $user->alumni;

            if ($request->hasFile('foto_alumni')) {
                Helper::deleteFileIfExistsInStorageFolder($alumni->foto);
            }

            if ($alumni->nis !== $validatedData['nis']) {
                $validatedData['password'] = Hash::make($validatedData['nis']);
                $validatedData['new_username'] = $validatedData['nis'];
                $user->update([
                    'username' => $validatedData['new_username'],
                    'password' => $validatedData['password'],
                ]);
            } else {
                $validatedData['password'] = null;
                $validatedData['new_username'] = null;
            }

            $dataAlumni = [
                'id_angkatan' => $validatedData['angkatan'],
                'id_jurusan' => $validatedData['jurusan'],
                'nis' => $validatedData['nis'],
                'nama_lengkap' => $validatedData['nama'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'no_telepon' => $validatedData['no_telp'],
                'alamat_tempat_tinggal' => $validatedData['alamat_alumni'],
                'foto' => $validatedData['foto_alumni'] ?? $alumni->foto,
            ];

            $user->alumni()->update($dataAlumni);

            notify()->success('Berhasil Memperbarui Data Alumni', 'Notifikasi');

            return to_route('admin.alumni.detail', ['user' => $user->username]);
        } catch (ItemNotFoundException) {
            notify()->error('Data alumni tidak ditemukan', 'Notifikasi');

            return $this->redirectToMainRoute();
        }
    }
}
