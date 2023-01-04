@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-8">
        <div class="card rounded shadow">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h4>Progress Lamaran Kerja</h4>
          </div>
          <div class="card-body d-flex flex-column gap-3">
            @forelse ($pendaftaranLowongan as $item)
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8 d-flex gap-2">
                      <img src="{{ asset('assets/images/7.jpeg') }}" width="50" alt="image">
                      <h4>{{ $item->lowongan->judul_lowongan }}</h4>
                    </div>
                    <div class="col-md-4">
                      <div style="text-align: right">
                        <h4>{{ $item->status_seleksi }}</h4>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                      <p class="text-muted">
                        {{ $item->lowongan->perusahaan->nama_perusahaan }}
                      </p>
                    </div>
                  </div>
                  <div class="row mt-1">
                    <div class="col">
                      <a href="#" class="btn btn-primary">lihat progress</a>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              kamu belum melamar lowongan
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
