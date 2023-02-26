<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Pengguna;

use App\Helpers\Helper;
use App\Http\Controllers\CloudinaryStorageController;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StorePersonRequest;
use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{Request, RedirectResponse};
use Illuminate\Support\Facades\{DB, Hash};
use Illuminate\Support\{ItemNotFoundException, Collection};
use Spatie\QueryBuilder\QueryBuilder;

final class MasyarakatController extends Controller {
    use HasMainRoute;

    public function __construct() {
        $this->setMainRoute('admin.pelamar.index');
    }

    private function getOnePersonByUsername(string $username): object {
        return collect(DB::select('CALL get_one_masyarakat_by_username(?)', [$username]))->firstOrFail();
    }

    private function generateKandidatUsername(string $name): string {
        return Helper::generateUniqueUsername('KDT', 5, $name);
    }

    public function getAllCandidateDataFromOutsideSchool(Request $request): View {
        $masyarakat = QueryBuilder::for(Masyarakat::class)
            ->with('pelamar')
            ->filter($request->q)
            ->active()
            ->latest('id_masyarakat')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengguna.masyarakat.index', compact('masyarakat'));
    }

    public function createOneCandidateDataFromOutsideSchool(): View {
        return view('admin.pengguna.masyarakat.tambah');
    }

    public function storeOneCandidateDataFromOutsideSchool(StorePersonRequest $request): RedirectResponse {
        try {
            $validatedData = $request->validatedData();
            $validatedData['username'] = $this->generateKandidatUsername($validatedData['nama']);

            if ($request->hasFile('foto_pelamar')) {
                $image = $request->file('foto_pelamar');
                $upload = CloudinaryStorageController::upload($image->getRealPath(), $image->getClientOriginalName());
                $validatedData['foto_pelamar'] = $upload['securePath'];
                $validatedData['public_foto_id'] = $upload['getPublicId'];
            }

            DB::insert("CALL insert_one_person(:username, :email, :password, :nama_lengkap, :jenis_kelamin, :no_telepon, :tempat_lahir, :tanggal_lahir, :alamat_tempat_tinggal, :foto, :public_foto_id)", [
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'nama_lengkap' => $validatedData['nama'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'no_telepon' => $validatedData['no_telp'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'alamat_tempat_tinggal' => $validatedData['alamat'],
                'foto' => $validatedData['foto_pelamar'] ?? null,
                'public_foto_id' => $validatedData['public_foto_id'] ?? null,
                'email' => NULL
            ]);

            notify()->success('Berhasil Menambahkan Data Kandidat Luar', 'Notifikasi');

            return $this->redirectToMainRoute();
        } catch (\Exception $e) {
            notify()->error($e->getMessage(), 'Notifikasi');

            return $this->redirectToMainRoute();
        }
    }

    public function getDetailOneCandidateDataFromOutsideSchoolByUsername(string $username): View|RedirectResponse {
        try {
            $orang = $this->getOnePersonByUsername($username);

            return view('admin.pengguna.masyarakat.detail', compact('orang'));
        } catch (ItemNotFoundException) {
            notify()->error('Data pelamar tidak ditemukan', 'Notifikasi');

            return $this->redirectToMainRoute();
        }
    }

    public function editOneCandidateDataFromOutsideSchool(string $username): View|RedirectResponse {
        try {
            $orang = $this->getOnePersonByUsername($username);

            return view('admin.pengguna.masyarakat.sunting', compact('orang'));
        } catch (ItemNotFoundException) {
            notify()->error('Data pelamar tidak ditemukan', 'Notifikasi');

            return $this->redirectToMainRoute()->with('error', 'Data pelamar tidak ditemukan');
        }
    }

    public function updateOneCandidateDataFromOutsideSchool(
        StorePersonRequest $request,
        string $username
    ): RedirectResponse {
        try {
            $orang = $this->getOnePersonByUsername($username);
            $validatedData = $request->validatedData();

            if ($request->hasFile('foto_pelamar')) {
                $image = $request->file('foto_pelamar');
                $upload = CloudinaryStorageController::replace($orang->public_foto_id, $image->getRealPath(), $image->getClientOriginalName());
                $validatedData['foto_pelamar'] = $upload['securePath'];
                $validatedData['public_foto_id'] = $upload['getPublicId'];
            }

            $validatedData['new_username'] = ($orang->nama_lengkap !== $validatedData['nama']) ?
                $this->generateKandidatUsername($validatedData['nama']) : NULL;

            DB::update("CALL update_one_person_by_username(:current_username, :nama_lengkap, :new_username, :jenis_kelamin, :no_telepon, :tempat_lahir, :tanggal_lahir, :alamat_tempat_tinggal, :foto, :public_foto_id)", [
                'current_username' => $orang->username ?? $username,
                'nama_lengkap' => $validatedData['nama'],
                'new_username' => $validatedData['new_username'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'no_telepon' => $validatedData['no_telp'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'alamat_tempat_tinggal' => $validatedData['alamat'],
                'foto' => $validatedData['foto_pelamar'] ?? $orang->foto,
                'public_foto_id' => $validatedData['public_foto_id'] ?? $orang->public_foto_id,
            ]);

            notify()->success('Berhasil memperbarui data kandidat luar', 'Notifikasi');

            return $this->redirectToMainRoute();
        } catch (ItemNotFoundException) {
            notify()->error('Data pelamar tidak ditemukan', 'Notifikasi');
            return $this->redirectToMainRoute()->with('error', 'Data pelamar tidak ditemukan');
        }
    }

    public function deactiveOneCandidateDataFromOutsideSchool(string $username): RedirectResponse {
        try {
            $akun = User::firstWhere('username', $username);
            $akun->pelamar->masyarakat->is_active = false;
            $akun->pelamar->masyarakat->save();

            notify()->success("Berhasil menonaktifkan akun {$akun->pelamar->masyarakat->nama_lengkap}", 'Notifikasi');
            return back();
        } catch (\Exception $e) {
            notify()->error($e->getMessage(), 'Notifikasi');
            return back();
        }
    }
}
