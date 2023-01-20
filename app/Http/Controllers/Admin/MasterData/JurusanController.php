<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Traits\HasMainRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class JurusanController extends Controller {
  use HasMainRoute;

  public function __construct() {
    $this->setMainRoute('admin.jurusan.index');
  }

  public function index() {
    $jurusan =  QueryBuilder::for(Jurusan::class)
      ->allowedFilters('angkatan_tahun')
      ->get();

    return view('admin.masterdata.jurusan.index', compact('jurusan'));
  }

  public function store(Request $request) {
    $request->validate([
      'kode_jurusan' => ['required'],
      'nama_jurusan' => ['required'],
      'keterangan_jurusan' => ['required'],
    ]);

    $validatedData = $request->only(['kode_jurusan', 'nama_jurusan', 'keterangan_jurusan']);
    $validatedData['id_jurusan'] = $validatedData['kode_jurusan'];
    $validatedData['keterangan'] = $validatedData['keterangan_jurusan'];
    Jurusan::create($validatedData);

    return to_route('admin.jurusan.index')
      ->with('sukses', 'Berhasil menambahkan jurusan baru');
  }

  public function show($id) {
    $data = collect(DB::select('SELECT * FROM jurusan WHERE id_jurusan = :kode_jurusan', [
      'kode_jurusan' => $id
    ]))->first();

    return response()->json($data);
  }

  public function update(Request $request, $id) {
    $request->validate([
      'kode_jurusan' => ['required'],
      'nama_jurusan' => ['required'],
      'keterangan_jurusan' => ['required'],
    ]);

    $validatedData = $request->only(['kode_jurusan', 'nama_jurusan', 'keterangan_jurusan']);
    $validatedData['id_jurusan'] = $validatedData['kode_jurusan'];
    $validatedData['keterangan'] = $validatedData['keterangan_jurusan'];
    Jurusan::firstWhere('id_jurusan', $validatedData['id_jurusan'])
      ->update($validatedData);

    return $this->redirectToMainRoute()
      ->with('sukses', 'berhasil memperbarui data jurusan');
  }

  public function destroy($kodejurusan) {
    try {
      Jurusan::firstWhere('id_jurusan', $kodejurusan)
        ->delete();

      return back()
        ->with('sukses', 'Berhasil hapus jurusan');
    } catch (\Exception $e) {
      return back()
        ->with('error', $e->getMessage());
    }
  }
}
