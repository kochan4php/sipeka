<?php

declare(strict_types=1);

namespace App\Http\Controllers\AdminDanPerusahaan;

use App\Models\LowonganKerja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SiswaAlumni;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RecomendationController extends Controller {
    /**
     * Kolom yang diquery dari tabel rekomendasi
     *
     * @var array
     */
    private $columns = [
        'sa.nama_lengkap',
        'sa.id_siswa',
        'rl.*',
        'lk.id_lowongan',
        'lk.judul_lowongan',
        'lk.posisi'
    ];

    /**
     * Mendapatkan semua data rekomendasi
     *
     * @return array|object
     */
    public function getDataRecomendations(): array|object {
        return  DB::table('rekomendasi_lowongan as rl')
            ->select($this->columns)
            ->join('siswa_alumni as sa', 'rl.id_siswa', '=', 'sa.id_siswa')
            ->join('lowongan_kerja as lk', 'rl.id_lowongan', '=', 'lk.id_lowongan')
            ->latest('rl.created_at')
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * Mendapatkan semua data rekomendasi berdasarkan keyword tertentu
     *
     * @param string|null $keyword
     * @return array|object
     */
    public function getDataRecomendationsByKeyword(?string $keyword): array|object {
        return DB::table('rekomendasi_lowongan as rl')
            ->select($this->columns)
            ->join('siswa_alumni as sa', 'rl.id_siswa', '=', 'sa.id_siswa')
            ->join('lowongan_kerja as lk', 'rl.id_lowongan', '=', 'lk.id_lowongan')
            ->where('sa.nama_lengkap', 'LIKE', "%{$keyword}%")
            ->orWhere('lk.judul_lowongan', 'LIKE', "%{$keyword}%")
            ->orWhere('lk.posisi', 'LIKE', "%{$keyword}%")
            ->latest('rl.created_at')
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * Menampilkan halaman utama untuk menampilkan semua data rekomendasi
     *
     * @param Request $request
     * @return View
     */
    public function getAllRecomendations(Request $request): View {
        $rekomendasi = null;

        if ($request->has('q')) {
            $rekomendasi = $this->getDataRecomendationsByKeyword($request->input('q'));
        } else {
            $rekomendasi = $this->getDataRecomendations();
        }

        return view('rekomendasi.index', compact('rekomendasi'));
    }

    /**
     * Menampilkan halaman form untuk menambah data rekomendasi baru
     *
     * @return View
     */
    public function createOneRecomendation(): View {
        $alumni = SiswaAlumni::all(['id_siswa', 'nama_lengkap']);
        $lowongan = [];

        if (Gate::check('admin')) {
            $lowongan = LowonganKerja::latest()
                ->approvedAndActive()
                ->hasTahapan()
                ->latest()
                ->get(['id_lowongan', 'judul_lowongan', 'posisi']);
        } else if (Gate::check('perusahaan')) {
            $lowongan = Auth::user()->perusahaan
                ->lowongan()
                ->approvedAndActive()
                ->hasTahapan()
                ->latest()
                ->get(['id_lowongan', 'judul_lowongan', 'posisi']);
        }

        return view('rekomendasi.tambah', compact('alumni', 'lowongan'));
    }

    /**
     * Memproses dan validasi data rekomendasi untuk di insert ke dalam tabel rekomendasi_lowongan
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeOneRecomendation(Request $request): RedirectResponse {
        $judul = '';
        $deskripsi = '';
        $loker = LowonganKerja::with('perusahaan')->find($request->id_lowongan);

        $rules = [
            'id_siswa' => 'required|array|min:1',
            'id_lowongan' => 'required',
        ];

        if (!$request->boolean('automatic_msg')) {
            $rules['judul'] = 'required';
            $rules['deskripsi'] = 'required';
            $judul = $request->judul;
            $deskripsi = $request->deskripsi;
        } else {
            $judul = "Selamat anda direkomendasikan untuk posisi {$loker->posisi} dari loker {$loker->judul_lowongan}";
            $deskripsi = "Anda direkomendasikan untuk posisi {$loker->posisi} di loker {$loker->judul_lowongan} di perusahaan {$loker->perusahaan->nama_perusahaan}. Daftarkan diri anda sekarang, jangan sampai terlewatkan!";
        }

        $request->validate($rules);
        $alumni = $request->id_siswa;

        foreach ($alumni as $item) {
            DB::table('rekomendasi_lowongan')
                ->insert([
                    'id_siswa' => $item,
                    'id_lowongan' => $request->id_lowongan,
                    'judul' => $judul,
                    'deskripsi' => $deskripsi,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        notify()->success('Berhasil menambahkan rekomendasi baru', 'Notifikasi');

        return to_route('rekomendasi.index');
    }

    /**
     * Menghapus salah satu data rekomendasi dari tabel rekomendasi_lowongan
     *
     * @param string $siswa
     * @param string $lowongan
     * @return RedirectResponse
     */
    public function deleteOneRecomendation(string $siswa, string $lowongan): RedirectResponse {
        DB::table('rekomendasi_lowongan')
            ->where('rekomendasi_lowongan.id_siswa', '=', decrypt($siswa))
            ->where('rekomendasi_lowongan.id_lowongan', '=', decrypt($lowongan))
            ->delete();

        notify()->success('Berhasil menghapus data rekomendasi', 'Notifikasi');

        return back();
    }
}
