<?php

use App\Http\Controllers\{
  Auth\RegistrationController,
  Auth\AuthenticatedController,
  Auth\LogoutController,
  Admin\AlumniController,
  Admin\MasyarakatController
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
  Route::get('/', fn () => view('index'))->name('home');

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
    Route::get('/', fn () => view('admin.index'))->name('admin.index');
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
