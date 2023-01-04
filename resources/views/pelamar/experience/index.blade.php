@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3>Experience Saya</h3>
            <a href="{{ route('pelamar.experience.add', Auth::user()->username) }}" class="btn custom-btn btn-primary"
              type="button">Tambah</a>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 d-flex flex-column gap-3">
                @forelse ($pengalamanKerja as $pk)
                  <div class="card">
                    <div class="card-body pb-0">
                      <div class="d-flex justify-content-between">
                        <div>
                          <h4>{{ $pk->judul_posisi }}</h4>
                          <h5>{{ $pk->nama_perusahaan }}</h5>
                          <div class="d-flex gap-2">
                            <p>{{ \Carbon\Carbon::parse($pk->tanggal_masuk)->format('d M Y') }}</p>
                            <span>-</span>
                            <p>{{ \Carbon\Carbon::parse($pk->tanggal_selesai)->format('d M Y') }}</p>
                          </div>
                          <p>Indonesia</p>
                        </div>
                        <div>
                          <div class="d-flex gap-1">
                            <a href="{{ route('pelamar.experience.edit', ['username' => Auth::user()->username, 'id' => $pk->id_pengalaman]) }}"
                              class="btn custom-btn btn-warning">
                              <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                            </a>
                            <form
                              action="{{ route('pelamar.experience.delete', ['username' => Auth::user()->username, 'id' => $pk->id_pengalaman]) }}"
                              method="post">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn custom-btn btn-danger">
                                <span><i class="fa-solid fa-trash fa-lg"></i></span>
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="card">
                    <div class="card-body custom-font text-center">
                      Kamu belum memiliki pengalaman kerja.
                    </div>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
