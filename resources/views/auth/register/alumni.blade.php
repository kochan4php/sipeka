@extends('auth.register.layouts', ['title' => 'Daftar Sebagai Alumni SMKN 1 Bekasi'])

@section('register')
  <div>
    <h2 class="text-center mb-3">Daftar Sebagai Alumni</h2>
  </div>
  <div>
    <x-alert-error-validation />
  </div>
  <div>
    <form action="{{ route('register.alumni.store') }}" method="post">
      @csrf
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="username" name="username" placeholder="deo-subarno"
          value="{{ old('username') }}">
        <label for="username">Username</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="deosubarno@gmail.com"
          value="{{ old('email') }}">
        <label for="email">Email</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Deo Subarno"
          value="{{ old('nama') }}">
        <label for="nama">Nama Lengkap</label>
      </div>
      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="nis" name="nis" placeholder="202192837483"
          value="{{ old('nis') }}">
        <label for="nis">NIS</label>
      </div>
      <div class="form-floating mb-3">
        <div class="form-floating">
          <select class="form-select" id="floatingSelect" name="jurusan" aria-label="Floating label select example">
            <option selected>-- Pilih Jurusan --</option>
            @foreach ($jurusan as $jrs)
              <option value="{{ $jrs->id_jurusan }}">{{ $jrs->nama_jurusan }}</option>
            @endforeach
          </select>
          <label for="floatingSelect">Jurusan</label>
        </div>
      </div>
      <div class="form-floating mb-3">
        <div class="form-floating">
          <select class="form-select" id="floatingSelect" name="angkatan" aria-label="Floating label select example">
            <option selected>-- Pilih Tahun Angkatan --</option>
            @foreach ($angkatan as $agk)
              <option value="{{ $agk->id_angkatan }}">{{ $agk->angkatan_tahun }}</option>
            @endforeach
          </select>
          <label for="floatingSelect">Tahun Angkatan</label>
        </div>
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
