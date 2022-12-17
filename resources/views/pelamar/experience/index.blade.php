@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3>Experience Saya</h3>
            <a href="{{ route('pelamar.experience.add', 'layla') }}" class="btn btn-primary" type="button">Tambah</a>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 d-flex flex-column gap-3">
                @foreach ($pengalamanKerja as $pk)
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
                          <div class="btn-group">
                            <a href="{{ route('pelamar.experience.edit', $pk->id_pengalaman) }}" class="btn btn-warning">
                              <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                            </a>
                            <form action="{{ route('pelamar.experience.delete', $pk->id_pengalaman) }}" method="post">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger">
                                <span><i class="fa-solid fa-trash fa-lg"></i></span>
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
