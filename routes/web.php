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
  Admin\MasterData\DokumenController,
  // All Perusahaan Controller
  Perusahaan\LowonganController,
  // All Pelamar Controller
  Pelamar\PengalamanKerjaController
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
      Route::get('/register/kandidat', 'kandidat')->name('register.kandidat');
      Route::post('/register/kandidat', 'kandidatStore')->name('register.kandidat.store');
      Route::get('/register/alumni', 'alumni')->name('register.alumni');
      Route::post('/register/alumni', 'alumniStore')->name('register.alumni.store');
    });

    Route::controller(AuthenticatedController::class)->group(function () {
      Route::get('/login', 'index')->name('login');
      Route::post('/login', 'authenticate')->name('login.store');
    });
  });

  Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');

    // Dashboard
    Route::prefix('/dashboard')->group(function () {
      // Route Admin BKK
      Route::prefix('/admin')->middleware('role:admin')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\MainController::class)->name('admin.index');

        Route::prefix('/pengguna')->group(function () {
          Route::prefix('/alumni')->controller(AlumniController::class)->group(function () {
            Route::get('/', 'index')->name('admin.alumni.index');
            Route::get('/tambah', 'create')->name('admin.alumni.create');
            Route::post('/', 'store')->name('admin.alumni.store');
            Route::get('/{nis}/detail', 'show')->name('admin.alumni.detail');
            Route::get('/{nis}/sunting', 'edit')->name('admin.alumni.edit');
            Route::put('/{nis}', 'update')->name('admin.alumni.update');
            Route::delete('/{nis}', 'destroy')->name('admin.alumni.delete');
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
            Route::get('/{angkatan}/detail', 'show')->name('admin.angkatan.detail');
            Route::put('/{angkatan}', 'update')->name('admin.angkatan.update');
            Route::delete('/{angkatan}', 'destroy')->name('admin.angkatan.delete');
          });

          Route::prefix('/dokumen')->controller(DokumenController::class)->group(function () {
            Route::get('/', 'index')->name('admin.dokumen.index');
            Route::post('/', 'store')->name('admin.dokumen.store');
            Route::get('/{dokumen}/detail', 'show')->name('admin.dokumen.detail');
            Route::put('/{dokumen}', 'update')->name('admin.dokumen.update');
            Route::delete('/{dokumen}', 'destroy')->name('admin.dokumen.delete');
          });
        });
      });

      // Route Mitra Perusahaan
      Route::prefix('/perusahaan')->middleware('role:perusahaan')->group(function () {
        Route::controller(LowonganController::class)->group(function () {
          Route::get('/', 'index')->name('perusahaan.index');
          Route::get('/tambah-lowongan', 'create')->name('perusahaan.lowongankerja.create');
          Route::post('/', 'store')->name('perusahaan.lowongankerja.store');
          Route::get('/{id}/detail', 'show')->name('perusahaan.lowongankerja.detail');
          Route::get('/{id}/edit', 'edit')->name('perusahaan.lowongankerja.edit');
          Route::put('/{id}', 'update')->name('perusahaan.lowongankerja.update');
          Route::delete('/{id}', 'destroy')->name('perusahaan.lowongankerja.delete');
        });

        Route::controller(PelamarController::class)->group(function () {
          Route::get('/', 'index')->name('perusahaan.pelamar.index');
          Route::get('/{id}/detail', 'show')->name('perusahaan.pelamar.detail');
        });
      });

      // Route Seleksi oleh Admin dan Mitra Perusahaan
      Route::prefix('/seleksi')->middleware('role:admin,perusahaan')->group(function () {
        Route::get('/', fn () => 'Hehe');
      });
    });

  // Route Pelamar (Masyarakat dan Siswa Alumni)
  Route::prefix('/pelamar')->group(function () {
    Route::get('/profile', fn () => view('pelamar.profile'))->name('pelamar.profile');
    Route::get('/dokumen', fn () => view('pelamar.dokumen'))->name('pelamar.dokumen');
    Route::prefix('/pengalaman-kerja')->controller(PengalamanKerjaController::class)->group(function () {
      Route::get('/', 'index')->name('pelamar.experience.index');
      Route::get('/tambah-pengalaman', 'create')->name('pelamar.experience.add');
      Route::post('/', 'store')->name('pelamar.experience.store');
      Route::get('/{id}/edit', 'edit')->name('pelamar.experience.edit');
      Route::put('/{id}', 'update')->name('pelamar.experience.update');
      Route::put('/{id}', 'delete')->name('pelamar.experience.delete');
    });
    Route::prefix('/lamaran-kerja')->group(function () {
      Route::get('/', fn () => view('pelamar.lamaran_kerja.index'))->name('pelamar.lamaran.index');
    });
  });
});
