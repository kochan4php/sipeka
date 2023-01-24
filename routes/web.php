<?php

use App\Http\Controllers\{
  // All Auth Controller
  Auth\RegistrationController,
  Auth\AuthenticatedController,
  Auth\LogoutController,
  // All Pengguna Controller
  Admin\PenggunaController,
  Admin\Pengguna\AlumniController,
  Admin\Pengguna\MasyarakatController,
  Admin\Pengguna\MitraPerusahaanController,
  // All Master Data Controller
  Admin\MasterData\JurusanController,
  Admin\MasterData\AngkatanController,
  Admin\MasterData\DokumenController,
  // All Perusahaan Controller
  Perusahaan\PelamarController,
  // All Pelamar Controller
  Pelamar\PengalamanKerjaController,
  Pelamar\PendidikanController,
  Pelamar\LowonganKerjaController as PlmrLowonganKerjaController,
  Pelamar\PendaftaranLowonganController,
  Pelamar\DokumenController as PlmrDokumenController,
  // All Admin and Perusahaan Controller
  AdminDanPerusahaan\LowonganKerjaController as AMPLowonganKerjaController,
  AdminDanPerusahaan\TahapanSeleksiController,
  AdminDanPerusahaan\PenilaianSeleksiController,
  AdminDanPerusahaan\KantorController,
  VerifikasiPendaftaranLowonganController,
  // All Admin Sensitive Controller
  Admin\ProfileController as AdminProfileController,
  Admin\NotifikasiSeleksiController,
  // Change password for all users
  ChangePasswordController,
};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::redirect('/', '/sipeka');
Route::prefix('/sipeka')->group(function () {
  Route::get('/', \App\Http\Controllers\OuterController::class)
    ->name('home');

  // Route Lowongan Kerja yand dilihat oleh pelamar
  Route::get('/lowongan-kerja/{lowongan_kerja}', [PlmrLowonganKerjaController::class, 'show'])
    ->name('lowongan_kerja');
  Route::post('/lowongan-kerja/{lowongan_kerja}', [PlmrLowonganKerjaController::class, 'applyJob'])
    ->name('lowongan.apply');

  Route::middleware(['guest'])->group(function () {
    Route::controller(RegistrationController::class)->group(function () {
      Route::get('/register/kandidat', 'kandidat')
        ->name('register.kandidat');
      Route::post('/register/kandidat', 'kandidatStore')
        ->name('register.kandidat.store');
      Route::get('/register/alumni', 'alumni')
        ->name('register.alumni');
      Route::post('/register/alumni', 'alumniStore')
        ->name('register.alumni.store');
    });

    Route::controller(AuthenticatedController::class)->group(function () {
      Route::get('/login', 'index')
        ->name('login');
      Route::post('/login', 'authenticate')
        ->name('login.store');
    });
  });

  Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/logout', LogoutController::class)
      ->name('logout');

    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword'])
      ->name('change.password');

    // Dashboard
    Route::prefix('/dashboard')->group(function () {
      // Route Admin BKK
      Route::prefix('/admin')->middleware('role:admin')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\MainController::class)
          ->name('admin.index');

        Route::prefix('/pengguna')->controller(PenggunaController::class)->group(function () {
          Route::get('/', 'index')
            ->name('admin.pengguna.index');
          Route::get('/detail/{username}', 'show')
            ->name('admin.pengguna.show');
        });

        Route::prefix('/alumni')->controller(AlumniController::class)->group(function () {
          Route::get('/', 'getAllAlumniData')
            ->name('admin.alumni.index');
          Route::get('/tambah', 'createOneAlumniData')
            ->name('admin.alumni.create');
          Route::post('/', 'storeOneAlumniData')
            ->name('admin.alumni.store');
          Route::get('/{nis}/detail', 'getDetailOneAlumniDataByNIS')
            ->name('admin.alumni.detail');
          Route::get('/{nis}/sunting', 'editOneAlumniData')
            ->name('admin.alumni.edit');
          Route::put('/{nis}', 'updateOneAlumniData')
            ->name('admin.alumni.update');
          Route::delete('/{nis}', 'deleteOneAlumniData')
            ->name('admin.alumni.delete');
        });

        Route::prefix('/pelamar')->controller(MasyarakatController::class)->group(function () {
          Route::get('/', 'getAllCandidateDataFromOutsideSchool')
            ->name('admin.pelamar.index');
          Route::get('/tambah', 'createOneCandidateDataFromOutsideSchool')
            ->name('admin.pelamar.create');
          Route::post('/', 'storeOneCandidateDataFromOutsideSchool')
            ->name('admin.pelamar.store');
          Route::get('/{username}/detail', 'getDetailOneCandidateDataFromOutsideSchoolByUsername')
            ->name('admin.pelamar.detail');
          Route::get('/{username}/sunting', 'editOneCandidateDataFromOutsideSchool')
            ->name('admin.pelamar.edit');
          Route::put('/{username}', 'updateOneCandidateDataFromOutsideSchool')
            ->name('admin.pelamar.update');
          Route::delete('/{username}', 'deleteOneCandidateDataFromOutsideSchool')
            ->name('admin.pelamar.delete');
        });

        Route::prefix('/perusahaan')->controller(MitraPerusahaanController::class)->group(function () {
          Route::get('/', 'getAllMitraData')
            ->name('admin.perusahaan.index');
          Route::get('/tambah', 'createOneMitraData')
            ->name('admin.perusahaan.create');
          Route::post('/', 'storeOneMitraData')
            ->name('admin.perusahaan.store');
          Route::get('/{username}/detail', 'getDetailOneMitraDataByUsername')
            ->name('admin.perusahaan.detail');
          Route::get('/{username}/sunting', 'editOneMitraData')
            ->name('admin.perusahaan.edit');
          Route::put('/{username}', 'updateOneMitraData')
            ->name('admin.perusahaan.update');
          Route::delete('/{username}', 'deleteOneMitraData')
            ->name('admin.perusahaan.delete');
        });

        Route::prefix('/masterdata')->group(function () {
          Route::prefix('/jurusan')->controller(JurusanController::class)->group(function () {
            Route::get('/', 'index')
              ->name('admin.jurusan.index');
            Route::post('/', 'store')
              ->name('admin.jurusan.store');
            Route::get('/{kode_jurusan}/detail', 'show')
              ->name('admin.jurusan.detail');
            Route::put('/{kode_jurusan}', 'update')
              ->name('admin.jurusan.update');
          });

          Route::prefix('/angkatan')->controller(AngkatanController::class)->group(function () {
            Route::get('/', 'index')
              ->name('admin.angkatan.index');
            Route::post('/', 'store')
              ->name('admin.angkatan.store');
            Route::get('/{angkatan}/detail', 'show')
              ->name('admin.angkatan.detail');
            Route::put('/{angkatan}', 'update')
              ->name('admin.angkatan.update');
          });

          Route::prefix('/dokumen')->controller(DokumenController::class)->group(function () {
            Route::get('/', 'index')
              ->name('admin.dokumen.index');
            Route::post('/', 'store')
              ->name('admin.dokumen.store');
            Route::get('/{dokumen}/detail', 'show')
              ->name('admin.dokumen.detail');
            Route::put('/{dokumen}', 'update')
              ->name('admin.dokumen.update');
          });
        });

        Route::prefix('/profile')->controller(AdminProfileController::class)->group(function () {
          Route::get('/{admin}', 'index')
            ->name('admin.profile.index');
          Route::put('/{admin}', 'update')
            ->name('admin.profile.update');
        });
      });

      // Route Mitra Perusahaan
      Route::prefix('/perusahaan')->middleware('role:perusahaan')->group(function () {
        Route::get('/', \App\Http\Controllers\Perusahaan\MainController::class)
          ->name('perusahaan.index');
        Route::controller(PelamarController::class)->group(function () {
          Route::get('/pelamar', 'index')
            ->name('perusahaan.pelamar.index');
          Route::get('/pelamar/{user}/detail', 'show')
            ->name('perusahaan.pelamar.detail');
        });
      });

      // Route Kantor Mitra
      Route::prefix('/kantor')->controller(KantorController::class)->middleware('role:admin,perusahaan')->group(function () {
        Route::get('/', 'getAllKantorData')
          ->name('kantor.index');
        Route::get('/tambah', 'createOneKantorData')
          ->name('kantor.create');
        Route::post('/', 'storeOneKantorData')
          ->name('kantor.store');
        Route::get('/{kantor}', 'getDetailOneKantorData')
          ->name('kantor.detail');
        Route::get('/{kantor}/edit', 'editOneKantorData')
          ->name('kantor.edit');
        Route::put('/{kantor}', 'updateOneKantorData')
          ->name('kantor.update');
        Route::delete('/{kantor}', 'deleteOneKantorData')
          ->name('kantor.delete');
      });

      // Route Lowongan oleh Admin dan Mitra Perusahaan
      Route::prefix('/lowongan')->middleware('role:admin,perusahaan')->group(function () {
        Route::controller(AMPLowonganKerjaController::class)->group(function () {
          Route::get('/', 'index')
            ->name('lowongankerja.index');
          Route::get('/tambah', 'create')
            ->name('lowongankerja.create');
          Route::post('/', 'store')
            ->name('lowongankerja.store');
          Route::get('/{lowongan_kerja}/detail', 'show')
            ->name('lowongankerja.detail');
          Route::get('/{lowongan_kerja}/edit', 'edit')
            ->name('lowongankerja.edit');
          Route::put('/{lowongan_kerja}', 'update')
            ->name('lowongankerja.update');
          Route::post('/{lowongan_kerja}', 'nonActive')
            ->name('lowongankerja.nonactive');
        });

        Route::controller(TahapanSeleksiController::class)->prefix('/tahapan')->group(function () {
          Route::get('/{lowongan_kerja}/tambah', 'create')
            ->name('tahapan.seleksi.create');
          Route::get('/{lowongan_kerja}/detail', 'jobDetail')
            ->name('tahapan.seleksi.detail_lowongan');
          Route::post('/{lowongan_kerja}', 'store')
            ->name('tahapan.seleksi.store');
          Route::get('/{lowongan_kerja}/edit/{tahapan_seleksi}', 'edit')
            ->name('tahapan.seleksi.edit');
          Route::put('/{lowongan_kerja}/update/{tahapan_seleksi}', 'update')
            ->name('tahapan.seleksi.update');
          Route::delete('/{lowongan_kerja}/delete/{tahapan_seleksi}', 'destroy')
            ->name('tahapan.seleksi.delete');
        });
      });

      // Verifikasi lamaran kerja pelamar oleh admin
      Route::post(
        '/pendaftaran-lowongan/verifikasi/{pendaftaran_lowongan}',
        [VerifikasiPendaftaranLowonganController::class, 'verification']
      )->name('pendaftaran_lowongan.verifikasi');

      // Route Seleksi oleh Admin dan Mitra Perusahaan
      Route::prefix('/seleksi')->middleware('role:admin,perusahaan')->group(function () {
        Route::prefix('/penilaian')->group(function () {
          Route::controller(PenilaianSeleksiController::class)->group(function () {
            Route::get('/', 'index')
              ->name('penilaian.seleksi.index');
            Route::get('/{pendaftaran_lowongan}/detail', 'jobApplicationDetails')
              ->name('penilaian.seleksi.job_application_details');
            Route::get('/{pendaftaran_lowongan}/{tahapan_seleksi}/tambah', 'create')
              ->name('penilaian.seleksi.create');
            Route::post('/{pendaftaran_lowongan}/{tahapan_seleksi}/store', 'store')
              ->name('penilaian.seleksi.store');
            Route::get('/{pendaftaran_lowongan}/{tahapan_seleksi}/{penilaian_seleksi}/edit', 'edit')
              ->name('penilaian.seleksi.edit');
            Route::put('/{pendaftaran_lowongan}/{tahapan_seleksi}/{penilaian_seleksi}', 'update')
              ->name('penilaian.seleksi.update');
            Route::post('/{pendaftaran_lowongan}/pass_applicants', 'passApplicants')
              ->name('penilaian.seleksi.pass_applicants');
          });

          Route::prefix('/notifikasi-seleksi')->controller(NotifikasiSeleksiController::class)->group(function () {
            Route::get('/{pelamar}', 'index')
              ->name('notifikasi.seleksi.index');
            Route::post('/{pelamar}', 'store')
              ->name('notifikasi.seleksi.store');
            Route::delete('/{pelamar}/delete/{notifikasi_seleksi}', 'destroy')
              ->name('notifikasi.seleksi.destroy');
          });
        });
      });
    });

    // Route Pelamar (Masyarakat dan Siswa Alumni)
    Route::prefix('/pelamar/{username}')->middleware('role:pelamar')->group(function () {
      Route::get('/profile', \App\Http\Controllers\Pelamar\MainController::class)
        ->name('pelamar.index');
      Route::get('/profile/edit', [\App\Http\Controllers\Pelamar\MainController::class, 'profileEdit'])
        ->name('pelamar.profile.edit');
      Route::put('/profile', [\App\Http\Controllers\Pelamar\MainController::class, 'profileUpdate'])
        ->name('pelamar.profile.update');

      Route::prefix('/dokumen')->controller(PlmrDokumenController::class)->group(function () {
        Route::get('/', 'index')
          ->name('pelamar.dokumen');
        Route::post('/{dokumen}', 'store')
          ->name('pelamar.dokumen.store');
      });

      Route::prefix('/pengalaman-kerja')->controller(PengalamanKerjaController::class)->group(function () {
        Route::get('/', 'index')
          ->name('pelamar.experience.index');
        Route::get('/tambah', 'create')
          ->name('pelamar.experience.add');
        Route::post('/', 'store')
          ->name('pelamar.experience.store');
        Route::get('/{id}/edit', 'edit')
          ->name('pelamar.experience.edit');
        Route::put('/{id}', 'update')
          ->name('pelamar.experience.update');
        Route::delete('/{id}', 'destroy')
          ->name('pelamar.experience.delete');
      });

      Route::prefix('/pendidikan')->controller(PendidikanController::class)->group(function () {
        Route::get('/', 'index')
          ->name('pelamar.pendidikan.index');
        Route::get('/tambah', 'create')
          ->name('pelamar.pendidikan.add');
        Route::post('/', 'store')
          ->name('pelamar.pendidikan.store');
      });

      Route::prefix('/lamaran-kerja')->controller(PendaftaranLowonganController::class)->group(function () {
        Route::get('/', 'index')
          ->name('pelamar.lamaran.index');
        Route::get('/{pendaftaran_lowongan}/detail', 'show')
          ->name('pelamar.lamaran.detail');
        Route::get('/{pendaftaran_lowongan}/pdf-verifikasi', 'PDFVerifikasi')
          ->name('pelamar.lamaran.pdf-verifikasi');
      });
    });
  });

  // Artisan command
  Route::prefix('/artisan')->group(function () {
    Route::get('/storage-link-74RK3SYG', function (Request $request) {
      if (!$request->hasValidSignature()) abort(401);
      Artisan::call('storage:link');
      return to_route('home');
    })->name('storage.link');

    Route::get('/storage-link', function () {
      $url = URL::temporarySignedRoute('storage.link', now()->addSeconds('60'));
      return new JsonResponse(compact('url'));
    });
  });
});
