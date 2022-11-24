<?php

use App\Http\Controllers\{
  // All Auth Controller
  Auth\RegistrationController,
  Auth\AuthenticatedController,
  Auth\LogoutController,
  // All Pengguna Controller
  Admin\Pengguna\AlumniController,
  Admin\Pengguna\MasyarakatController,
  Admin\Pengguna\MitraPerusahaanController,
  // All Master Data Controller
  Admin\MasterData\JurusanController,
  Admin\MasterData\AngkatanController,
  Admin\MasterData\DokumenController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/sipeka');
Route::prefix('/sipeka')->group(function () {
  Route::view('/', 'index')->name('home');

  Route::middleware(['guest'])->group(function () {
    Route::controller(RegistrationController::class)->group(function () {
      Route::get('/register', 'index')->name('register.index');
      Route::post('/register', 'register')->name('register.store');
    });

    Route::controller(AuthenticatedController::class)->group(function () {
      Route::get('/login', 'index')->name('login.index');
      Route::post('/login', 'authenticate')->name('login.store');
    });
  });

  Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
  });

  // Route Admin BKK
  Route::prefix('/admin')->group(function () {
    Route::view('/', 'admin.index')->name('admin.index');

    Route::prefix('/pengguna')->group(function () {
      Route::prefix('/alumni')->controller(AlumniController::class)->group(function () {
        Route::get('/', 'index')->name('admin.alumni.index');
        Route::get('/tambah', 'create')->name('admin.alumni.create');
        Route::post('/', 'store')->name('admin.alumni.store');
        Route::get('/{kode_alumni}/detail', 'show')->name('admin.alumni.detail');
        Route::get('/{kode_alumni}/sunting', 'edit')->name('admin.alumni.edit');
        Route::put('/{kode_alumni}', 'update')->name('admin.alumni.update');
        Route::delete('/{kode_alumni}', 'destroy')->name('admin.alumni.delete');
      });

      Route::prefix('/pelamar')->controller(MasyarakatController::class)->group(function () {
        Route::get('/', 'index')->name('admin.pelamar.index');
        Route::get('/tambah', 'create')->name('admin.pelamar.create');
        Route::post('/', 'store')->name('admin.pelamar.store');
        Route::get('/{username}/detail', 'show')->name('admin.pelamar.detail');
        Route::get('/{username}/sunting', 'edit')->name('admin.pelamar.edit');
        Route::put('/{username}', 'update')->name('admin.pelamar.update');
        Route::delete('/{username}', 'destroy')->name('admin.pelamar.delete');
      });

      Route::prefix('/perusahaan')->controller(MitraPerusahaanController::class)->group(function () {
        Route::get('/', 'index')->name('admin.perusahaan.index');
        Route::get('/tambah', 'create')->name('admin.perusahaan.create');
        Route::post('/', 'store')->name('admin.perusahaan.store');
        Route::get('/{username}/detail', 'show')->name('admin.perusahaan.detail');
        Route::get('/{username}/sunting', 'edit')->name('admin.perusahaan.edit');
        Route::put('/{username}', 'update')->name('admin.perusahaan.update');
        Route::delete('/{username}', 'destroy')->name('admin.perusahaan.delete');
      });
    });

    Route::prefix('/masterdata')->group(function () {
      Route::prefix('/jurusan')->controller(JurusanController::class)->group(function () {
        Route::get('/', 'index')->name('admin.jurusan.index');
        Route::post('/', 'store')->name('admin.jurusan.store');
        Route::get('/{kode_jurusan}/detail', 'show')->name('admin.jurusan.detail');
        Route::put('/{kode_jurusan}', 'update')->name('admin.jurusan.update');
        Route::delete('/{kode_jurusan}', 'destroy')->name('admin.jurusan.delete');
      });

      Route::prefix('/angkatan')->controller(AngkatanController::class)->group(function () {
        Route::get('/', 'index')->name('admin.angkatan.index');
        Route::post('/', 'store')->name('admin.angkatan.store');
        Route::get('/{kode_angkatan}/detail', 'show')->name('admin.angkatan.detail');
        Route::put('/{kode_angkatan}', 'update')->name('admin.angkatan.update');
        Route::delete('/{kode_angkatan}', 'destroy')->name('admin.angkatan.delete');
      });

      Route::prefix('/dokumen')->controller(DokumenController::class)->group(function () {
        Route::get('/', 'index')->name('admin.dokumen.index');
        Route::post('/', 'store')->name('admin.dokumen.store');
        Route::get('/{kode_dokumen}/detail', 'show')->name('admin.dokumen.detail');
        Route::put('/{kode_dokumen}', 'update')->name('admin.dokumen.update');
        Route::delete('/{kode_dokumen}', 'destroy')->name('admin.dokumen.delete');
      });
    });
  });

  // Route Pelamar (Masyarakat dan Siswa Alumni)
  Route::prefix('/pelamar')->group(function () {
    Route::get('/', fn () => 'Halo ini halaman pelamar');
  });

  // Route Mitra Perusahaan
  Route::prefix('/perusahaan')->group(function () {
    Route::get('/', fn () => 'Halaman perusahaan');
  });
});
