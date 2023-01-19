<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Yajra\DataTables\DataTables;

class PenggunaController extends Controller {
  public function index(Request $request) {
    $users = QueryBuilder::for(User::class)
      ->allowedFilters(['username', 'email'])
      ->get();

    return view('admin.pengguna.index', compact('users'));
  }

  public function show(string $username) {
    $user = User::firstWhere('username', $username);
    return view('admin.pengguna.show', compact('user'));
  }
}
