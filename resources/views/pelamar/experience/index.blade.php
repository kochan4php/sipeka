@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3>Experience Saya</h3>
            <a href="{{ route('pelamar.experience.add', 'cina') }}" class="btn btn-primary" type="button">Tambah</a>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body pb-0">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h4>Judul Posisi</h4>
                        <h5>Nama Perusahaan</h5>
                        <div class="d-flex gap-2">
                          <p>Tanggal Mulai</p>
                          <span>-</span>
                          <p>Tanggal Selesai</p>
                        </div>
                        <p>Indonesia</p>
                      </div>
                      <div>
                        <div class="btn-group">
                          <a href="" class="btn btn-warning">
                            <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                          </a>
                          <a href="" class="btn btn-danger">
                            <span><i class="fa-solid fa-trash fa-lg"></i></span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
