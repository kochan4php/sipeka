<?php

use App\Http\Controllers\{
  Auth\RegistrationController,
  Auth\AuthenticatedController,
  Auth\LogoutController,
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

  Route::prefix('/admin')->group(function () {
    Route::get('/', fn () => view('admin.index'))->name('admin.index');
    Route::get('/alumni', fn () => view('admin.alumni.index'))->name('admin.alumni.index');
    Route::get('/alumni/tambah', fn () => view('admin.alumni.tambah'))->name('admin.alumni.create');
    Route::post('/alumni', fn () => 'Hehe berhasil')->name('admin.alumni.store');
    Route::get('/alumni/detail/{kode_alumni}', fn ($kode_alumni) => "{$kode_alumni}")->name('admin.alumni.detail');
    Route::get('/alumni/sunting', fn () => view('admin.alumni.sunting'))->name('admin.alumni.edit');
    Route::put('/alumni', fn () => 'Hehe berhasil')->name('admin.alumni.update');
  });

  Route::get('/pelamar', fn () => 'Halo ini halaman pelamar');

  Route::prefix('/perusahaan')->group(function () {
    Route::get('/', fn () => 'Halaman pelamar');
  });
});
