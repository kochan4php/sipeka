<?php

namespace App\Http\Controllers\Admin\Pengguna;

use App\Http\Controllers\Controller;
use App\Interface\HasMainRoute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MitraPerusahaanController extends Controller implements HasMainRoute
{
  private $mainRoute = 'admin.perusahaan.index';

  /**
   * Redirect to this controller main route.
   * Implements HasMainRoute interface
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function redirectToMainRoute(): RedirectResponse
  {
    return redirect()->route($this->mainRoute);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $perusahaan = collect(DB::select('SELECT * FROM get_all_perusahaan'));
    return view('admin.pengguna.perusahaan.index', compact('perusahaan'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.pengguna.perusahaan.tambah');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    return 'Hehe berhasil';
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($username)
  {
    $perusahaan = collect(DB::select('CALL get_perusahaan_by_username(?)', [$username]))->first();
    return view('admin.pengguna.perusahaan.detail', compact('perusahaan'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('admin.pengguna.perusahaan.sunting');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    return 'Hehe berhasil';
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    return 'Berhasil hapus data';
  }
}
