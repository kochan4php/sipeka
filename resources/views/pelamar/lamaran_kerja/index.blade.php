@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-9">
        <div class="card rounded shadow">
          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <h4>Progress Lamaran Kerja</h4>
          </div>
          <div class="card-body d-flex flex-column gap-3">
            @forelse ($pendaftaranLowongan as $item)
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col d-flex gap-3">
                      <div>
                        <img src="{{ asset('assets/images/7.jpeg') }}" width="60" alt="image"
                          class="img-thumbnail">
                      </div>
                      <div>
                        <h4>{{ $item->lowongan->judul_lowongan }}</h4>
                        <h5>{{ $item->status_seleksi }}</h5>
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
                      <a href="{{ route('pelamar.lamaran.detail', ['username' => Auth::user()->username, 'pendaftaran_lowongan' => $item->id_pendaftaran]) }}"
                        class="btn btn-primary custom-btn">
                        Lihat Progress
                      </a>
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
@endsection
