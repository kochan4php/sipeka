@extends('layouts.app')

@section('container')
    <div class="container mb-5" style="margin-top: 120px;">
        <div class="row gap-4 gap-md-0">
            @include('pelamar.action')
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3>Tambah Pendidikan</h3>
                        <a href="{{ route('pelamar.pendidikan.index', Auth::user()->username) }}" class="btn btn-danger"
                            type="button">Batal</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <x-alert-error-validation />
                                <form action="{{ route('pelamar.pendidikan.store', Auth::user()->username) }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="institut_or_universitas"
                                            class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                            {{ __('Institut/Universitas') }}
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="institut_or_universitas"
                                                name="institut_or_universitas" placeholder="Universitas Pasundan" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="tahun_kelulusan"
                                            class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                            {{ __('Tahun Kelulusan') }}
                                        </label>
                                        <div class="col-sm-8 d-flex gap-2">
                                            <select name="bulan" id="bulan" class="form-select" required>
                                                <option selected>-- Bulan --</option>
                                                <option value="Januari">Januari</option>
                                                <option value="Februari">Februari</option>
                                                <option value="Maret">Maret</option>
                                                <option value="April">April</option>
                                                <option value="Mei">Mei</option>
                                                <option value="Juni">Juni</option>
                                                <option value="Juli">Juli</option>
                                                <option value="Agustus">Agustus</option>
                                                <option value="September">September</option>
                                                <option value="Oktober">Oktober</option>
                                                <option value="November">November</option>
                                                <option value="Desember">Desember</option>
                                            </select>
                                            <input type="text" class="form-control" id="tahun" name="tahun"
                                                placeholder="2022" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="kualifikasi" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                            {{ __('Kualifikasi') }}
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="kualifikasi" id="kualifikasi" class="form-select" required>
                                                <option selected>-- Kualifikasi --</option>
                                                @foreach ($kualifikasi as $gp)
                                                    <option value="{{ $gp->id_gelar }}">{{ $gp->nama_gelar }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="informasi_tambahan"
                                            class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                            {{ __('Informasi Tambahan') }}
                                        </label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" placeholder="Informasi Tambahan" id="informasi_tambahan" name="informasi_tambahan"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-8 d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
