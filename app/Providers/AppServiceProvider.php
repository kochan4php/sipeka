<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot(): void {
    Paginator::useBootstrapFive();
    Gate::define(
      'admin',
      fn (User $user) => ($user->level_user->identifier === 'admin') || (Auth::user()->level_user->identifier === 'admin')
    );
    Gate::define(
      'perusahaan',
      fn (User $user) => ($user->level_user->identifier === 'perusahaan') || (Auth::user()->level_user->identifier === 'perusahaan')
    );
    Gate::define(
      'pelamar',
      fn (User $user) => ($user->level_user->identifier === 'pelamar') || (Auth::user()->level_user->identifier === 'pelamar')
    );
  }
}
