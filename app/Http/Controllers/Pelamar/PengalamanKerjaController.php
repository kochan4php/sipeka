<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\PengalamanBekerja;
use Illuminate\Http\Request;

class PengalamanKerjaController extends Controller
{
    public function index()
    {
        $pengalamanKerja = PengalamanBekerja::all();
        return view('pelamar.experience.index', compact('pengalamanKerja'));
    }

    public function create()
    {
        return view('pelamar.experience.tambah');
    }

    public function store(Request $request)
    {
        $validatedData = $request->only([
            "judul_posisi",
            "nama_perusahaan",
            "tanggal_masuk",
            "tanggal_selesai",
            "deskripsi_pengalaman"
        ]);

        $pengalamanKerja = new PengalamanBekerja();
        $pengalamanKerja->judul_posisi = $validatedData['judul_posisi'];
        $pengalamanKerja->nama_perusahaan = $validatedData['nama_perusahaan'];
        $pengalamanKerja->tanggal_masuk = $validatedData['tanggal_masuk'];
        $pengalamanKerja->tanggal_selesai = $validatedData['tanggal_selesai'];
        $pengalamanKerja->deskripsi_pengalaman = $validatedData['deskripsi_pengalaman'];
        $pengalamanKerja->id_pelamar = 3;
        $pengalamanKerja->save();

        return redirect()->route('pelamar.experience.index',);
    }
}
