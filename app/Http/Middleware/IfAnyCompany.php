<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IfAnyCompany
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $message = 'Data perusahaan belum ada. Silahkan tambah data Perusahaan jika ingin menambahkan data Lowongan baru.';
    abort_if(\App\Models\MitraPerusahaan::all()->count() === 0, 403, $message);
    return $next($request);
  }
}
