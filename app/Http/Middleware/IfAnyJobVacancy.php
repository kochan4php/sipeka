<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IfAnyJobVacancy {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next) {
    $message = 'Data Lowongan Pekerjaan masih kosong. Silahkan tambah data Lowongan Pekerjaan jika anda ingin menambahkan tahapan seleksi di setiap Lowongan Pekerjaan.';
    abort_if(\App\Models\LowonganKerja::all()->count() === 0, 403, $message);
    return $next($request);
  }
}
