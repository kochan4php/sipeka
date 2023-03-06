<?php

use App\Http\Controllers\{
    // * All Auth Controller
    Auth\RegistrationController,
    Auth\AuthenticatedController,
    Auth\LogoutController,

    // * All Admin Controller
    Admin\PenggunaController,
    Admin\Pengguna\AlumniController,
    Admin\Pengguna\MasyarakatController,
    Admin\Pengguna\MitraPerusahaanController,
    Admin\MasterData\JurusanController,
    Admin\MasterData\AngkatanController,
    Admin\MasterData\DokumenController,
    Admin\ProfileController as AdminProfileController,
    Admin\PendaftaranLowonganController as ADMPendaftaranLowonganController,

    // * All Perusahaan Controller
    Perusahaan\ProfileController as MitraProfileController,

    // * All Pelamar Controller
    Pelamar\PengalamanKerjaController,
    Pelamar\PendidikanController,
    Pelamar\LowonganKerjaController as PlmrLowonganKerjaController,
    Pelamar\PendaftaranLowonganController as PlmrPendaftaranLowonganController,
    Pelamar\DokumenController as PlmrDokumenController,
    Pelamar\RecomendationController as AlumniRecomendationController,

    // * All Admin and Perusahaan Controller
    AdminDanPerusahaan\LowonganKerjaController as AMPLowonganKerjaController,
    AdminDanPerusahaan\TahapanSeleksiController,
    AdminDanPerusahaan\KantorController,
    AdminDanPerusahaan\RecomendationController,

    // * Change password for all users
    ChangePasswordController,
};
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/sipeka');

Route::prefix('/sipeka')->group(function () {
    // * Route untuk menampilkan halaman landing page / home page
    Route::get('/', \App\Http\Controllers\OuterController::class)
        ->name('home');

    // * Route untuk menampilkan detail lowongan kerja dari halaman landing page / home page
    Route::get('lowongan-kerja/{lowongan_kerja}', [PlmrLowonganKerjaController::class, 'show'])
        ->name('lowongan_kerja');

    // * Route untuk proses register dan login
    Route::middleware(['guest'])->group(function () {
        // * Route untuk melakukan proses registrasi dari pelamar yang berasal dari luar sekolah
        Route::controller(RegistrationController::class)->group(function () {
            // * Route yang menampilkan halaman register untuk para pelamar yang berasal dari luar sekolah
            Route::get('register/kandidat', 'kandidat')
                ->name('register.kandidat');

            // * Route untuk memproses register dari para pelamar yang berasal dari luar sekolah
            Route::post('register/kandidat', 'kandidatStore')
                ->name('register.kandidat.store');
        });

        // * Route untuk melakukan proses login untuk seluruh pengguna
        Route::controller(AuthenticatedController::class)->group(function () {
            // * Route yang menampilkkan halaman login untuk seluruh pengguna
            Route::get('login', 'index')
                ->name('login');

            // * Route untuk memproses login dari seluruh pengguna
            Route::post('login', 'authenticate')
                ->name('login.store');
        });
    });

    // * Route yang hanya bisa diakses oleh user yang sudah login dan terverifikasi emailnya
    Route::middleware(['auth', 'verified'])->group(function () {
        // * Route untuk para pengguna melakukan logout dari sistem
        Route::post('logout', LogoutController::class)
            ->name('logout');

        // * Route untuk mengubah password dari akun para pengguna
        Route::post('change-password', [ChangePasswordController::class, 'updatePassword'])
            ->name('change.password');

        // * Route yang digunakan pelamar untuk melamar lowongan pekerjaan
        Route::post('lowongan-kerja/{lowongan_kerja}', [PlmrLowonganKerjaController::class, 'applyJob'])
            ->middleware('role:pelamar')
            ->name('lowongan.apply');

        // * Route untuk menampilkan halaman dashboard untuk Admin dan Mitra
        Route::prefix('dashboard')->group(function () {
            // * Route untuk role Admin BKK
            Route::prefix('admin')->middleware('role:admin')->group(function () {
                // * Route yang menampilkan halaman utama di dashboard admin
                Route::get('/', \App\Http\Controllers\Admin\MainController::class)
                    ->name('admin.index');

                // * Route admin untuk menampilkan halaman yang berisi daftar pengguna dari sistem
                Route::get('pengguna', PenggunaController::class)
                    ->name('admin.pengguna.index');

                // * Route admin untuk mengelola data pelamar yang merupakan alumni
                Route::prefix('alumni')->controller(AlumniController::class)->group(function () {
                    // * Route untuk menampilkan semua data alumni
                    Route::get('/', 'getAllAlumniData')
                        ->name('admin.alumni.index');

                    // * Route untuk menampilkan halaman form untuk menambah data alumni
                    Route::get('tambah', 'createOneAlumniData')
                        ->name('admin.alumni.create');

                    // * Route untuk memproses hasil tambah data alumni
                    Route::post('/', 'storeOneAlumniData')
                        ->name('admin.alumni.store');

                    // * Route untuk menampilkan halaman yang berisi detail data alumni
                    Route::get('{user}/detail', 'getDetailOneAlumniDataByUsername')
                        ->name('admin.alumni.detail');

                    // * Route untuk menampilkan halmaan form untuk menyunting data alumni
                    Route::get('{user}/sunting', 'editOneAlumniData')
                        ->name('admin.alumni.edit');

                    // * Route untuk memproses hasil sunting data alumni
                    Route::put('{user}', 'updateOneAlumniData')
                        ->name('admin.alumni.update');

                    // * Route untuk menonaktifkan akun dari alumni
                    Route::put('{user}/non-active', 'deactiveOneAlumniData')
                        ->name('admin.alumni.deactive');

                    // * Route untuk membuat laporan data alumni berformat file excel
                    Route::get('exports', 'exportAllAlumniDataToExcel')
                        ->name('admin.alumni.exports');
                });

                // * Route admin untuk mengelola data pelamar yang berasal dari luar sekolah
                Route::prefix('pelamar')->controller(MasyarakatController::class)->group(function () {
                    // * Route untuk menampilkan halaman dari semua data pelamar dari luar sekolah
                    Route::get('/', 'getAllCandidateDataFromOutsideSchool')
                        ->name('admin.pelamar.index');

                    // * Route untuk menampilkan halaman form untuk menambah data pelamar dari luar sekolah
                    Route::get('tambah', 'createOneCandidateDataFromOutsideSchool')
                        ->name('admin.pelamar.create');

                    // * Route untuk memproses hasil tambah data pelamar dari luar sekolah
                    Route::post('/', 'storeOneCandidateDataFromOutsideSchool')
                        ->name('admin.pelamar.store');

                    // * Route untuk menampilkan halaman detail data dari pelamar yang berasal dari luar sekolah
                    Route::get('{username}/detail', 'getDetailOneCandidateDataFromOutsideSchoolByUsername')
                        ->name('admin.pelamar.detail');

                    // * Route untuk menampilkan halaman form untuk menyunting data pelamar dari luar sekolah
                    Route::get('{username}/sunting', 'editOneCandidateDataFromOutsideSchool')
                        ->name('admin.pelamar.edit');

                    // * Route untuk memproses hasil sunting data pelamar dari luar sekolah
                    Route::put('{username}', 'updateOneCandidateDataFromOutsideSchool')
                        ->name('admin.pelamar.update');

                    // * Route untuk menonaktifkan akun dari pelamar yang berasal dari luar sekolah
                    Route::put('{username}/deactive', 'deactiveOneCandidateDataFromOutsideSchool')
                        ->name('admin.pelamar.deactive');
                });

                // * Route admin untuk mengelola data mitra yang bekerja sama dengan pihak sekolah
                Route::prefix('perusahaan')->controller(MitraPerusahaanController::class)->group(function () {
                    Route::get('/', 'getAllMitraData')
                        ->name('admin.perusahaan.index');

                    Route::get('tambah', 'createOneMitraData')
                        ->name('admin.perusahaan.create');

                    Route::post('/', 'storeOneMitraData')
                        ->name('admin.perusahaan.store');

                    Route::get('{user}/detail', 'getDetailOneMitraDataByUsername')
                        ->name('admin.perusahaan.detail');

                    Route::get('{user}/sunting', 'editOneMitraData')
                        ->name('admin.perusahaan.edit');

                    Route::put('{user}', 'updateOneMitraData')
                        ->name('admin.perusahaan.update');

                    Route::post('{user}/block', 'blockOneMitra')
                        ->name('admin.perusahaan.block');
                });

                // * Route admin untuk mengelola master data jurusan, angkatan dan jenis dokumen
                Route::prefix('masterdata')->group(function () {
                    // * Route admin untuk mengelola data jurusan
                    Route::prefix('jurusan')->controller(JurusanController::class)->group(function () {
                        Route::get('/', 'index')
                            ->name('admin.jurusan.index');

                        Route::post('/', 'store')
                            ->name('admin.jurusan.store');

                        Route::get('{kode_jurusan}/detail', 'show')
                            ->name('admin.jurusan.detail');

                        Route::put('{kode_jurusan}', 'update')
                            ->name('admin.jurusan.update');
                    });

                    // * Route admin untuk mengelola data angkatan
                    Route::prefix('angkatan')->controller(AngkatanController::class)->group(function () {
                        Route::get('/', 'getAllAngkatanData')
                            ->name('admin.angkatan.index');

                        Route::post('/', 'storeOneAngkatanData')
                            ->name('admin.angkatan.store');

                        Route::get('{angkatan}/detail', 'getOneDetailAngkatanData')
                            ->name('admin.angkatan.detail');

                        Route::put('{angkatan}', 'updateOneAngkatanData')
                            ->name('admin.angkatan.update');
                    });

                    // * Route admin untuk mengelola data dokumen
                    Route::prefix('dokumen')->controller(DokumenController::class)->group(function () {
                        Route::get('/', 'index')
                            ->name('admin.dokumen.index');

                        Route::post('/', 'store')
                            ->name('admin.dokumen.store');

                        Route::get('{dokumen}/detail', 'show')
                            ->name('admin.dokumen.detail');

                        Route::put('{dokumen}', 'update')
                            ->name('admin.dokumen.update');
                    });
                });

                // * Route admin untuk mengelola profile dirinya
                Route::prefix('profile')->controller(AdminProfileController::class)->group(function () {
                    Route::get('{admin}', 'index')
                        ->name('admin.profile.index');

                    Route::put('{admin}', 'update')
                        ->name('admin.profile.update');
                });

                // * Route admin untuk mengelola pendaftaran lowongan dari pelamar
                Route::prefix('pendaftaran-lowongan')->controller(ADMPendaftaranLowonganController::class)->group(function () {
                    Route::get('/', 'getAllJobRegistrationData')
                        ->name('admin.pendaftaran-lowongan.index');

                    Route::get('{pendaftaran_lowongan}/setujui', 'jobVacancyRegistrationApproval')
                        ->name('admin.pendaftaran-lowongan.approve');

                    Route::get('{pendaftaran_lowongan}/tolak', 'jobVacancyRegistrationApproval')
                        ->name('admin.pendaftaran-lowongan.reject');
                });
            });

            // * Route Mitra Perusahaan
            Route::prefix('/perusahaan')->middleware('role:perusahaan')->group(function () {
                Route::get('/', \App\Http\Controllers\Perusahaan\MainController::class)
                    ->name('perusahaan.index');

                Route::controller(AlumniController::class)->prefix('/alumni')->group(function () {
                    Route::get('/', 'getAllAlumniData')
                        ->name('perusahaan.alumni.index');

                    Route::get('/{user}/detail', 'getDetailOneAlumniDataByUsername')
                        ->name('perusahaan.alumni.detail');
                });

                Route::prefix('/profile')->controller(MitraProfileController::class)->group(function () {
                    Route::get('/', 'showProfile')
                        ->name('perusahaan.profile.index');

                    Route::put('/', 'updateProfile')
                        ->name('perusahaan.profile.update');
                });
            });

            // * Route untuk admin dan mitra
            Route::middleware('role:admin,perusahaan')->group(function () {
                // * Route Kantor Mitra
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

                    // * Route::get('/list/cetak-pdf', 'createPDF')
                    // *     ->name('kantor.pdf');
                });

                // * Route Lowongan oleh Admin dan Mitra Perusahaan
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

                        Route::get('/{lowongan_kerja}/pendaftar', 'seeApplicants')
                            ->name('lowongankerja.see-applicant');

                        Route::get('/{lowongan_kerja}/edit', 'editOneJobVacancyData')
                            ->name('lowongankerja.edit');

                        Route::put('/{lowongan_kerja}', 'updateOneJobVacancyData')
                            ->name('lowongankerja.update');

                        Route::post('/{lowongan_kerja}', 'deactiveOneJobVacancy')
                            ->name('lowongankerja.nonactive');

                        Route::middleware('role:perusahaan')->group(function () {
                            Route::get('/{lowongan_kerja}/see-stages', 'seeStages')
                                ->name('lowongankerja.see-stages');

                            Route::get('/{lowongan_kerja}/{tahapan_seleksi}/applicant-selection', 'applicantSelection')
                                ->name('lowongankerja.applicant-selection');

                            Route::post('/{lowongan_kerja}/{tahapan_seleksi}/applicant-selection', 'storeApplicantSelection')
                                ->name('lowongankerja.applicant-selection.store');
                        });
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

                        Route::middleware('role:admin')->group(function () {
                            Route::get('/need-approve', 'selectionProcessThatRequiresApproval')
                                ->name('tahapan.seleksi.need-approve');

                            Route::post('/{tahapan_seleksi}/approve', 'verifiedSelectionStages')
                                ->name('tahapan.seleksi.approve');

                            Route::post('/{tahapan_seleksi}/reject', 'verifiedSelectionStages')
                                ->name('tahapan.seleksi.reject');
                        });
                    });
                });

                // * Route Rekomendasikan Lowongan oleh Admin dan Mitra Perusahaan
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

        // * Route Pelamar (Masyarakat dan Siswa Alumni)
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
});
