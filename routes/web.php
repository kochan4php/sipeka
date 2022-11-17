<?php

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
  Route::get('/', function () {
    return view('index');
  });

  Route::prefix('/admin')->group(function () {
    Route::get('/', fn () => 'Halo ini halaman admin');
  });

  Route::get('/pelamar', fn () => 'Halo ini halaman pelamar');
});
