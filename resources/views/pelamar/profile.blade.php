@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-8">
        <div class="card card-outline-secondary">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-">Profil Saya </h3>
            <h5 class="mb-0">Bonong</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nama Lengkap</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                Bonong jenong
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Agama</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                ada
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Tempat Tanggal Lahir</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                bojong gede 19 mei 2022
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Tinggi dan Berat Badan</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                10 cm 1 kg
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Jenis Kelamin</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                cwk
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Latar Belakang Pendidikan</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                esdeh
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Alamat</h6>
              </div>
              bojong gede kalideres
              <div class="col-sm-9 text-secondary">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                bonong@gmail.com
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">No Hp</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                09876543
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Facebook</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                bonong manies
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Twitter</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                bonong_ajah
              </div>
            </div>
            <hr>
            <a href="">
              <button class="btn btn-sm btn-primary">Edit Profil</button>
            </a>
            <a href="">
              <button class="btn btn-sm btn-green">Ubah Password</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
