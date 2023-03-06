<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

final class PenggunaController extends Controller {
    public function __invoke(Request $request): View {
        $users = QueryBuilder::for(User::class)
            ->oldest('id_level')
            ->filter($request->q)
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengguna.index', compact('users'));
    }
}
