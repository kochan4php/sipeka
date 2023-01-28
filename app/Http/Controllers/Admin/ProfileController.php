<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminBKK;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class ProfileController extends Controller {
  public function index(AdminBKK $admin): View {
    return view('admin.profile.index', compact('admin'));
  }

  public function update(Request $request, AdminBKK $admin): RedirectResponse {
    $request->validate(['nama_admin' => 'required|min:5|max:255', 'nip' => 'required']);
    $validatedData = $request->only('nama_admin', 'nip');
    $admin->update($validatedData);

    return back()->with('sukses', 'Berhasil memperbarui data');
  }
}
