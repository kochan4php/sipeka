<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Models\User;
use App\Helpers\Helper;
use App\Traits\HasMainRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pengguna\StorePersonRequest;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\{DB, Hash};
use Illuminate\Support\{ItemNotFoundException, Collection};
use Spatie\QueryBuilder\QueryBuilder;

class MasyarakatController extends Controller {
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

  public function index() {
    $masyarakat = QueryBuilder::for(Masyarakat::class)
      ->allowedFilters('nama_lengkap')
      ->allowedSorts('id')
      ->with('pelamar')
      ->get();

    return view('admin.pengguna.masyarakat.index', compact('masyarakat'));
  }

  public function create() {
    return view('admin.pengguna.masyarakat.tambah');
  }

  public function store(StorePersonRequest $request) {
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

      return $this->redirectToMainRoute()->with('sukses', 'Berhasil Menambahkan Data Pelamar');
    } catch (\Exception $e) {
      return $this->redirectToMainRoute()->with('error', $e->getMessage());
    }
  }

  public function show(string $username) {
    try {
      $orang = $this->getOnePersonByUsername($username);

      return view('admin.pengguna.masyarakat.detail', compact('orang'));
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data pelamar tidak ditemukan');
    }
  }

  public function edit(string $username) {
    try {
      $orang = $this->getOnePersonByUsername($username);

      return view('admin.pengguna.masyarakat.sunting', compact('orang'));
    } catch (ItemNotFoundException $e) {
      return $this->redirectToMainRoute()->with('error', 'Data pelamar tidak ditemukan');
    }
  }

  public function update(StorePersonRequest $request, string $username) {
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

      return $this->redirectToMainRoute()->with('sukses', 'Berhasil Memperbarui Data Pelamar');
    } catch (ItemNotFoundException) {
      return $this->redirectToMainRoute()->with('error', 'Data pelamar tidak ditemukan');
    }
  }

  public function destroy(string $username) {
    try {
      $orang = $this->getOnePersonByUsername($username);
      User::whereUsername($orang->username)->delete();
      Helper::deleteFileIfExistsInStorageFolder($orang->foto);

      return back()->with('sukses', 'Berhasil hapus data pelamar');
    } catch (\Exception $e) {
      return back()->with('error', $e->getMessage());
    }
  }
}
