@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-9">
        <div class="card card-outline-secondary">
          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <h3>Rekomendasi Loker</h3>
            <h5>{{ Auth::user()->alumni->nama_lengkap }}</h5>
          </div>
          <div class="card-body custom-font">
            <div class="row">
              <div class="col-sm-12 d-flex flex-column gap-3">
                @forelse ($rekomendasi as $item)
                  <a href="{{ route('alumni.rekomendasi.show', [
                      'username' => Auth::user()->username,
                      'siswa' => encrypt(Auth::user()->alumni->id_siswa),
                      'lowongan' => encrypt($item->id_lowongan),
                  ]) }}"
                    class="text-decoration-none text-dark">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div>
                            <h5 class="fw-semibold truncate">{{ \Illuminate\Support\Str::limit($item->judul, 42) }}</h5>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <small class="text-muted">
                          <span>Added by Admin</span>
                          <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                        </small>
                      </div>
                    </div>
                  </a>
                @empty
                  <div class="card">
                    <div class="card-body custom-font text-center">
                      Kamu belum memiliki data pendidikan.
                    </div>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection
