@extends('layouts.dashboard.app')

@section('container-dashboard')
    <div class="row pt-3 pb-1 mb-1">
        <div class="col">
            <div class="card">
                <div class="card-header pb-0">
                    <h2>Tambah Tahapan Seleksi</h2>
                </div>
                <div class="card-body pb-0">
                    <x-alert-error-validation />
                    <form action="{{ route('tahapan.seleksi.store', $lowonganKerja->slug) }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="judul_lowongan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Judul Lowongan') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="judul_lowongan" name="judul_lowongan"
                                    value="{{ $lowonganKerja->judul_lowongan }}" readonly disabled>
                            </div>
                        </div>
                        @can('admin')
                            <div class="mb-3 row">
                                <label for="nama_perusahaan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                    {{ __('Nama Perusahaan') }}
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                                        value="{{ $lowonganKerja->perusahaan->nama_perusahaan }}" readonly disabled>
                                </div>
                            </div>
                        @endcan
                        <div class="mb-3 row">
                            <label for="urutan_tahapan_ke" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Urutan tahapan') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="urutan_tahapan_ke" name="urutan_tahapan_ke"
                                    placeholder="1" readonly value="{{ $urutanTahapanTerakhir }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="judul_tahapan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Judul Tahapan Seleksi') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('judul_tahapan')is-invalid @enderror"
                                    id="judul_tahapan" name="judul_tahapan"
                                    placeholder="Tes Interview dengan perusahaan yang dituju"
                                    value="{{ old('judul_tahapan') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tanggal_dimulai" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Tanggal tahapan dimulai') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control @error('tanggal_dimulai')is-invalid @enderror"
                                    id="tanggal_dimulai" name="tanggal_dimulai" value="{{ old('tanggal_dimulai') }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="ket_tahapan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Keterangan Tahapan Seleksi') }}
                            </label>
                            <div class="col-sm-8">
                                <textarea class="form-control @error('ket_tahapan')is-invalid @enderror"
                                    placeholder="Pergi ke perusahaan yang dituju untuk melakukan seleksi tes interview" id="ket_tahapan"
                                    name="ket_tahapan" rows="5" autocomplete="off">
                </textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8 d-flex gap-2">
                                <button type="submit" class="btn custom-btn btn-primary">Tambah</button>
                                <a href="{{ route('tahapan.seleksi.detail_lowongan', $lowonganKerja->slug) }}"
                                    class="btn custom-btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
