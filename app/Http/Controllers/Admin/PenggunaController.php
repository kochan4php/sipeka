<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

final class PenggunaController extends Controller {
  public function index(Request $request): View {
    $users = QueryBuilder::for(User::class)
      ->oldest('id_level')
      ->paginate(10)
      ->withQueryString();

    return view('admin.pengguna.index', compact('users'));
  }

  public function show(string $username): View {
    $user = User::firstWhere('username', $username);
    return view('admin.pengguna.show', compact('user'));
  }
}
