<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\PengalamanBekerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $pengalamanKerja->id_pelamar = 1;
        $pengalamanKerja->save();

        return redirect()->route('pelamar.experience.index',);
    }

    public function edit($id)
    {
        $pengalamanKerja = PengalamanBekerja::where('id_pengalaman', $id)->first();

        return view('pelamar.experience.sunting', compact('pengalamanKerja'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->only([
            "judul_posisi",
            "nama_perusahaan",
            "tanggal_masuk",
            "tanggal_selesai",
            "deskripsi_pengalaman"
        ]);



        PengalamanBekerja::where('id_pengalaman', $id)->update($validatedData);
        return redirect()->route('pelamar.experience.index')->with('sukses', 'berhasil memperbarui data pengalaman');
    }

    public function destroy($id)
    {
        try {
            if ($pengalamanKerja->delete()) return back()->with('sukses', 'Berhasil di hapus ');
            else return redirect()->back()->with('error', 'Gagal menghapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
