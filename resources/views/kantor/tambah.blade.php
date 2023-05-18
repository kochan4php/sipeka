@extends('layouts.dashboard.app')

@section('container-dashboard')
    <form action="{{ route('kantor.store') }}" method="POST">
        @csrf
        @if (!empty($errors->all()))
            <div class="row pt-3 pb-1 mb-1">
                <div class="col">
                    <x-alert-error-validation />
                </div>
            </div>
        @endif
        <div class="row pt-3 pb-1 mb-1">
            <div class="col">
                <div class="card">
                    <div class="card-header pb-0">
                        <h2>Tambah data kantor</h2>
                    </div>
                    <div class="card-body">
                        @can('admin')
                            <div class="mb-3 row">
                                <label for="id_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                    {{ __('Nama Mitra Perusahaan') }}
                                </label>
                                <div class="col-sm-8">
                                    <select name="id_perusahaan" id="id_perusahaan" class="form-select" required>
                                        <option selected disabled hidden>-- Pilih Mitra --</option>
                                        @foreach ($mitra as $item)
                                            <option value="{{ $item->id_perusahaan }}">
                                                {{ $item->nama_perusahaan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endcan
                        <div class="mb-3 row">
                            <label for="wilayah_kantor"
                                class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Wilayah Kantor') }}
                            </label>
                            <div class="col-sm-8">
                                <select name="wilayah_kantor" id="wilayah_kantor" class="form-select" required>
                                    <option selected disabled hidden>-- Pilih wilayah kantor --</option>
                                    @foreach ($kota as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="status_kantor" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Status Kantor') }}
                            </label>
                            <div class="col-sm-8">
                                <select name="status_kantor" id="status_kantor" class="form-select" required>
                                    <option selected disabled hidden>-- Pilih status kantor --</option>
                                    <option value="Kantor Pusat">Kantor Pusat</option>
                                    <option value="Kantor Cabang">Kantor Cabang</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="no_telp_kantor"
                                class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('No. Telepon Kantor') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="no_telp_kantor" name="no_telp_kantor"
                                    placeholder="08988928239" value="{{ old('no_telp_kantor') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="alamat_kantor" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Alamat Kantor') }}
                            </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" placeholder="Leave a comment here" id="alamat_kantor" name="alamat_kantor"
                                    rows="3">
                {{ old('alamat_kantor') }}
                </textarea>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="kantor_utama" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Jadikan Sebagai Kantor Utama') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="checkbox" class="form-check" id="kantor_utama" name="kantor_utama"
                                    value="true">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 justify-content-center w-full">
            <div class="col-sm-6 d-flex gap-2">
                <a href="{{ route('kantor.index') }}" class="btn custom-btn btn-danger w-full">Batal</a>
                <button type="submit" class="btn custom-btn btn-primary w-full">Tambah</button>
            </div>
        </div>
    </form>
@endsection
