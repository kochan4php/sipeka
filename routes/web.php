<?php

use App\Http\Controllers\{
  // All Auth Controller
  Auth\RegistrationController,
  Auth\AuthenticatedController,
  Auth\LogoutController,

  // All Admin Controller
  Admin\PenggunaController,
  Admin\Pengguna\AlumniController,
  Admin\Pengguna\MasyarakatController,
  Admin\Pengguna\MitraPerusahaanController,
  Admin\MasterData\JurusanController,
  Admin\MasterData\AngkatanController,
  Admin\MasterData\DokumenController,
  Admin\ProfileController as AdminProfileController,
  Admin\PendaftaranLowonganController as ADMPendaftaranLowonganController,

  // All Perusahaan Controller
  Perusahaan\PelamarController,
  Perusahaan\PenilaianSeleksiController,

  // All Pelamar Controller
  Pelamar\PengalamanKerjaController,
  Pelamar\PendidikanController,
  Pelamar\LowonganKerjaController as PlmrLowonganKerjaController,
  Pelamar\PendaftaranLowonganController as PlmrPendaftaranLowonganController,
  Pelamar\DokumenController as PlmrDokumenController,
  Pelamar\RecomendationController as AlumniRecomendationController,

  // All Admin and Perusahaan Controller
  AdminDanPerusahaan\LowonganKerjaController as AMPLowonganKerjaController,
  AdminDanPerusahaan\TahapanSeleksiController,
  AdminDanPerusahaan\KantorController,
  AdminDanPerusahaan\RecomendationController,

  // Change password for all users
  ChangePasswordController,
};
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\{Artisan, Route, URL};

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
          Route::get('/{user}/detail', 'getDetailOneAlumniDataByNIS')
            ->name('admin.alumni.detail');
          Route::get('/{user}/sunting', 'editOneAlumniData')
            ->name('admin.alumni.edit');
          Route::put('/{user}', 'updateOneAlumniData')
            ->name('admin.alumni.update');
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
          Route::post('/{user}/block', 'blockOneMitra')
            ->name('admin.perusahaan.block');
          Route::post('/{user}/unblock', 'unblockOneMitra')
            ->name('admin.perusahaan.unblock');
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
            Route::get('/', 'getAllAngkatanData')
              ->name('admin.angkatan.index');
            Route::post('/', 'storeOneAngkatanData')
              ->name('admin.angkatan.store');
            Route::get('/{angkatan}/detail', 'getOneDetailAngkatanData')
              ->name('admin.angkatan.detail');
            Route::put('/{angkatan}', 'updateOneAngkatanData')
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

        // Route Pendaftaran Lowongan oleh Admin
        Route::prefix('/pendaftaran-lowongan')->controller(ADMPendaftaranLowonganController::class)->group(function () {
          Route::get('/', 'getAllJobRegistrationData')
            ->name('admin.pendaftaran-lowongan.index');
          Route::get('/{pendaftaran_lowongan}/setujui', 'jobVacancyRegistrationApproval')
            ->name('admin.pendaftaran-lowongan.approve');
          Route::get('/{pendaftaran_lowongan}/tolak', 'jobVacancyRegistrationApproval')
            ->name('admin.pendaftaran-lowongan.reject');
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

        // Route Seleksi oleh Mitra Perusahaan
        Route::prefix('/seleksi/penilaian')->controller(PenilaianSeleksiController::class)->group(function () {
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
      });

      // Route untuk admin dan mitra
      Route::middleware('role:admin,perusahaan')->group(function () {
        // Route Kantor Mitra
        Route::prefix('/kantor')->controller(KantorController::class)->group(function () {
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
        Route::prefix('/lowongan')->group(function () {
          Route::controller(AMPLowonganKerjaController::class)->group(function () {
            Route::get('/', 'getAllJobVacanciesData')
              ->name('lowongankerja.index');
            Route::get('/{mitra}/kantor', 'getKantorJSONFormat')
              ->name('loker.kantor');
            Route::get('/need-approve', 'jobVacanciesThatRequireApproval')
              ->name('lowongankerja.jobVacanciesThatRequireApproval');
            Route::get('/need-approve/{lowongan_kerja}/approve', 'approveJobVacancies')
              ->name('lowongankerja.approveJobVancancies');
            Route::get('/need-approve/{lowongan_kerja}/reject', 'rejectJobVacancies')
              ->name('lowongankerja.rejectJobVancancies');
            Route::post('/need-approve/{lowongan_kerja}', 'jobVacanciesThatRequireApproval')
              ->name('lowongankerja.jobVacanciesThatRequireApproval.store');
            Route::get('/tambah', 'createOneJobVacancyData')
              ->name('lowongankerja.create');
            Route::post('/', 'storeOneJobVacancyData')
              ->name('lowongankerja.store');
            Route::get('/{lowongan_kerja}/detail', 'getDetailOneJobVacancyData')
              ->name('lowongankerja.detail');
            Route::get('/{lowongan_kerja}/edit', 'editOneJobVacancyData')
              ->name('lowongankerja.edit');
            Route::put('/{lowongan_kerja}', 'updateOneJobVacancyData')
              ->name('lowongankerja.update');
            Route::post('/{lowongan_kerja}', 'deactiveOneJobVacancy')
              ->name('lowongankerja.nonactive');
          });

          Route::controller(TahapanSeleksiController::class)->prefix('/tahapan')->group(function () {
            Route::get('/{lowongan_kerja}/tambah', 'createOneStagesOfSelection')
              ->name('tahapan.seleksi.create');
            Route::get('/{lowongan_kerja}/detail', 'jobVacancyDetail')
              ->name('tahapan.seleksi.detail_lowongan');
            Route::post('/{lowongan_kerja}', 'storeOneStagesOfSelection')
              ->name('tahapan.seleksi.store');
            Route::get('/{lowongan_kerja}/edit/{tahapan_seleksi}', 'editOneStagesOfSelection')
              ->name('tahapan.seleksi.edit');
            Route::put('/{lowongan_kerja}/update/{tahapan_seleksi}', 'updateOneStagesOfSelection')
              ->name('tahapan.seleksi.update');
          });
        });

        // Route Rekomendasikan Lowongan oleh Admin dan Mitra Perusahaan
        Route::prefix('/rekomendasi')->controller(RecomendationController::class)->group(function () {
          Route::get('/', 'getAllRecomendations')
            ->name('rekomendasi.index');
          Route::get('/tambah', 'createOneRecomendation')
            ->name('rekomendasi.create');
          Route::post('/', 'storeOneRecomendation')
            ->name('rekomendasi.store');
          Route::delete('/{siswa}/{lowongan}', 'deleteOneRecomendation')
            ->name('rekomendasi.delete');
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

      Route::prefix('/lamaran-kerja')->controller(PlmrPendaftaranLowonganController::class)->group(function () {
        Route::get('/', 'index')
          ->name('pelamar.lamaran.index');
        Route::get('/{pendaftaran_lowongan}/detail', 'show')
          ->name('pelamar.lamaran.detail');
        Route::get('/{pendaftaran_lowongan}/pdf-verifikasi', 'PDFVerifikasi')
          ->name('pelamar.lamaran.pdf-verifikasi');
      });

      Route::prefix('/rekomendasi')->controller(AlumniRecomendationController::class)->middleware('is_alumni')->group(function () {
        Route::get('/', 'getAllRecomendation')
          ->name('alumni.rekomendasi.index');
        Route::get('/{siswa}/{lowongan}', 'getDetailRecomendation')
          ->name('alumni.rekomendasi.show');
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
