<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Models\User;
use App\Helpers\Helper;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StorePersonRequest;
use App\Models\Masyarakat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{DB, Hash};
use Illuminate\Support\{ItemNotFoundException, Collection};
use Spatie\QueryBuilder\QueryBuilder;

final class MasyarakatController extends Controller {
  use HasMainRoute;

  public function __construct() {
    $this->setMainRoute('admin.pelamar.index');
  }

  private function getAllPersons(): Collection {
    return collect(DB::select('SELECT * FROM get_all_masyarakat'));
  }

  private function getOnePersonByUsername(string $username): object {
    return collect(DB::select('CALL get_one_masyarakat_by_username(?)', [$username]))->firstOrFail();
  }

  private function generateKandidatUsername(string $name): string {
    return Helper::generateUniqueUsername('KDT', 5, $name);
  }

  public function getAllCandidateDataFromOutsideSchool(): View {
    $masyarakat = QueryBuilder::for(Masyarakat::class)
      ->allowedFilters('nama_lengkap')
      ->allowedSorts('id')
      ->with('pelamar')
      ->get();

    return view('admin.pengguna.masyarakat.index', compact('masyarakat'));
  }

  public function createOneCandidateDataFromOutsideSchool(): View {
    return view('admin.pengguna.masyarakat.tambah');
  }

  public function storeOneCandidateDataFromOutsideSchool(StorePersonRequest $request): RedirectResponse {
    try {
      $validatedData = $request->validatedDataPerson();
      $validatedData['username'] = $this->generateKandidatUsername($validatedData['nama']);

      DB::insert("CALL insert_one_person(:username, :email, :password, :nama_lengkap, :jenis_kelamin, :no_telepon, :tempat_lahir, :tanggal_lahir, :alamat_tempat_tinggal, :foto)", [
        'username' => $validatedData['username'],
        'password' => Hash::make($validatedData['password']),
        'nama_lengkap' => $validatedData['nama'],
        'jenis_kelamin' => $validatedData['jenis_kelamin'],
        'no_telepon' => $validatedData['no_telp'],
        'tempat_lahir' => $validatedData['tempat_lahir'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
        'alamat_tempat_tinggal' => $validatedData['alamat'],
        'foto' => $validatedData['foto_pelamar'],
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

  public function updateOneCandidateDataFromOutsideSchool(StorePersonRequest $request, string $username): RedirectResponse {
    try {
      $orang = $this->getOnePersonByUsername($username);
      $validatedData = $request->validatedDataPerson();

      if ($request->hasFile('foto_pelamar')) {
        Helper::deleteFileIfExistsInStorageFolder($orang->foto);
      }

      $validatedData['new_username'] = ($orang->nama_lengkap !== $validatedData['nama']) ?
        $this->generateKandidatUsername($validatedData['nama']) : NULL;

      DB::update("CALL update_one_person_by_username(:current_username, :nama_lengkap, :new_username, :jenis_kelamin, :no_telepon, :tempat_lahir, :tanggal_lahir, :alamat_tempat_tinggal, :foto)", [
        'current_username' => $orang->username ?? $username,
        'nama_lengkap' => $validatedData['nama'],
        'new_username' => $validatedData['new_username'],
        'jenis_kelamin' => $validatedData['jenis_kelamin'],
        'no_telepon' => $validatedData['no_telp'],
        'tempat_lahir' => $validatedData['tempat_lahir'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
        'alamat_tempat_tinggal' => $validatedData['alamat'],
        'foto' => $validatedData['foto_pelamar']
      ]);

      notify()->success('Berhasil memperbarui data kandidat luar', 'Notifikasi');

      return $this->redirectToMainRoute();
    } catch (ItemNotFoundException) {
      notify()->error('Data pelamar tidak ditemukan', 'Notifikasi');

      return $this->redirectToMainRoute()->with('error', 'Data pelamar tidak ditemukan');
    }
  }

  public function deleteOneCandidateDataFromOutsideSchool(string $username): RedirectResponse {
    try {
      $orang = $this->getOnePersonByUsername($username);
      User::whereUsername($orang->username)->delete();
      Helper::deleteFileIfExistsInStorageFolder($orang->foto);

      return back()->with('sukses', 'Berhasil hapus data pelamar');
    } catch (\Exception $e) {
      notify()->error($e->getMessage(), 'Notifikasi');

      return back();
    }
  }
}
