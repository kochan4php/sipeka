@extends('auth.register.layouts', ['title' => 'Daftar Sebagai Kandidat'])

@section('register')
  <div>
    <h2 class="text-center mb-3">Daftar Sebagai Kandidat</h2>
  </div>
  <div>
    <x-alert-error-validation />
  </div>
  <div>
    <form action="{{ route('register.kandidat.store') }}" method="post">
      @csrf
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="username" name="username" placeholder="deo-subarno">
        <label for="username">Username</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="deo-subarno">
        <label for="email">Email</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Deo Subarno">
        <label for="nama">Nama Lengkap</label>
      </div>
      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="089882736473">
        <label for="no_telp">No. Telp</label>
      </div>
      <div class="row justify-content-between align-items-center">
        <div class="col-5">
          <span>
            <span>Sudah terdaftar? </span>
            <a href="{{ route('login') }}" class="text-decoration-none">
              Login!
            </a>
          </span>
        </div>
        <div class="col-5">
          <button type="submit" class="btn btn-success w-100 btn-block fs-5 btn-sm">Daftar</button>
        </div>
      </div>
    </form>
  </div>
@endsection
