<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Pengguna;

use App\Exports\AlumniExport;
use App\Models\{LevelUser, User, SiswaAlumni};
use App\Helpers\Helper;
use App\Http\Controllers\CloudinaryStorageController;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StoreAlumniRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{Request, RedirectResponse};
use Illuminate\Support\Facades\{DB, Gate, Hash};
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Spatie\QueryBuilder\QueryBuilder;

final class AlumniController extends Controller {
    use HasMainRoute;

    public function __construct() {
        $this->setMainRoute('admin.alumni.index');
    }

    /**
     * Mendapatkan semua data jurusan
     *
     * @return Collection
     */
    private function getJurusan(): Collection {
        return collect(DB::select('SELECT * FROM jurusan'));
    }

    /**
     * Mendapatkan semua data angkatan
     *
     * @return Collection
     */
    private function getAngkatan(): Collection {
        return collect(DB::select('SELECT * FROM angkatan'));
    }

    /**
     * Melakukan export data alumni dari database ke file excel
     *
     * @return BinaryFileResponse
     */
    public function exportAllAlumniDataToExcel(): BinaryFileResponse {
        return (new AlumniExport)->download(
            "alumni-" . now('Asia/Jakarta')->format('Y-M-d-H-i-s') . ".xlsx",
            \Maatwebsite\Excel\Excel::XLSX
        );
    }

    /**
     * Mendapatkan semua data alumni lalu ditampilkan ke view blade
     *
     * @param Request $request
     * @return View
     */
    public function getAllAlumniData(Request $request): View {
        // $alumni = QueryBuilder::for(SiswaAlumni::class)
        //     ->with(['jurusan', 'angkatan', 'pelamar'])
        //     ->filter($request->q)
        //     ->active()
        //     ->latest('id_angkatan')
        //     ->paginate(10)
        //     ->withQueryString();

        $alumni = [];

        if ($request->has('q')) {
            $alumni = DB::table('get_all_siswa_alumni')
                ->where('nis', 'LIKE', "%{$request->q}%")
                ->orWhere('nama_lengkap', 'LIKE', "%{$request->q}%")
                ->orWhere('nama_jurusan', 'LIKE', "%{$request->q}%")
                ->orWhere('keterangan', 'LIKE', "%{$request->q}%")
                ->orWhere('angkatan_tahun', 'LIKE', "%{$request->q}%")
                ->orWhere('username', 'LIKE', "%{$request->q}%")
                ->paginate(10)
                ->withQueryString();
        } else {
            $alumni = DB::table('get_all_siswa_alumni')
                ->select()
                ->paginate(10)
                ->withQueryString();
        }

        return Gate::check('admin') ?
            view('admin.pengguna.alumni.index', compact('alumni')) :
            view('perusahaan.alumni.index', compact('alumni'));
    }

    /**
     * Menampilkan halaman form untuk menambah data alumni
     *
     * @return View
     */
    public function createOneAlumniData(): View {
        $jurusan = $this->getJurusan();
        $angkatan = $this->getAngkatan();
        return view('admin.pengguna.alumni.tambah', compact('jurusan', 'angkatan'));
    }

    /**
     * Memvalidasi dan melakukan insert data alumni dari form ke dalam tabel siswa_alumni
     *
     * @param StoreAlumniRequest $request
     * @return RedirectResponse
     */
    public function storeOneAlumniData(StoreAlumniRequest $request): RedirectResponse {
        try {
            $validatedData = $request->validatedData();
            $validatedData['username'] = $validatedData['nis'];
            $validatedData['password'] = Hash::make($validatedData['nis']);
            $level = LevelUser::firstWhere('identifier', 'pelamar');

            if ($request->hasFile('foto_alumni')) {
                $image = $request->file('foto_alumni');
                $upload = CloudinaryStorageController::upload($image->getRealPath(), $image->getClientOriginalName());
                $validatedData['foto_alumni'] = $upload['securePath'];
                $validatedData['public_foto_id'] = $upload['getPublicId'];
            }

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
                'foto' => $validatedData['foto_alumni'] ?? null,
                'public_foto_id' => $validatedData['public_foto_id'] ?? null,
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

    /**
     * Menadapatkan satu data alumni berdasarkan username lalu ditampilkan ke view blade
     *
     * @param User $user
     * @return View|RedirectResponse
     */
    public function getDetailOneAlumniDataByUsername(User $user): View|RedirectResponse {
        $alumni = $user->alumni;

        return Gate::check('admin') ?
            view('admin.pengguna.alumni.detail', compact('alumni', 'user')) :
            view('perusahaan.alumni.detail', compact('alumni', 'user'));
    }

    /**
     * Menampilkan halaman form edit untuk mengubah data alumni
     *
     * @param User $user
     * @return View|RedirectResponse
     */
    public function editOneAlumniData(User $user): View|RedirectResponse {
        $jurusan = $this->getJurusan();
        $angkatan = $this->getAngkatan();
        $alumni = $user->alumni;

        return view('admin.pengguna.alumni.sunting', compact('jurusan', 'angkatan', 'alumni', 'user'));
    }

    /**
     * Memvalidasi dan memproses data alumni lalu melakukan proses update data siswa_alumni
     *
     * @param StoreAlumniRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function updateOneAlumniData(StoreAlumniRequest $request, User $user): RedirectResponse {
        $validatedData = $request->validatedData();
        $alumni = $user->alumni;

        if ($request->hasFile('foto_alumni')) {
            Helper::deleteFileIfExistsInStorageFolder($alumni->foto);
        }

        if ($request->hasFile('foto_alumni')) {
            $image = $request->file('foto_alumni');
            $upload = CloudinaryStorageController::replace($alumni->public_foto_id, $image->getRealPath(), $image->getClientOriginalName());
            $validatedData['foto_alumni'] = $upload['securePath'];
            $validatedData['public_foto_id'] = $upload['getPublicId'];
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
            'public_foto_id' => $validatedData['public_foto_id'] ?? $alumni->public_foto_id,
        ];

        $user->alumni()->update($dataAlumni);

        notify()->success('Berhasil Memperbarui Data Alumni', 'Notifikasi');

        return to_route('admin.alumni.detail', ['user' => $user->username]);
    }

    /**
     * Menonaktifkan akun alumni ketika sudah lama tidak digunakan
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function deactiveOneAlumniData(User $user): RedirectResponse {
        $user->alumni->update(['is_active' => false]);
        notify()->success('Berhasil menonaktifkan data alumni', 'Notifikasi');
        return back();
    }
}
