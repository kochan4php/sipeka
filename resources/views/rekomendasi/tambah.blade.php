@extends('layouts.dashboard.app')

@push('style')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/select2-custom.css') }}" rel="stylesheet" />
@endpush

@section('container-dashboard')
    @if ($lowongan->count() === 0)
        <div class="row pt-3">
            <div class="col">
                <div class="alert alert-warning custom-font">
                    Lowongan Kerja tersedia atau lowongan kerja yang sudah ada belum memiliki tahapan seleksi.
                </div>
            </div>
        </div>
    @endif
    <div class="row pt-3 pb-1 mb-1">
        <div class="col">
            <div class="card">
                <div class="card-header pb-0">
                    <h2>Tambah Rekomendasi</h2>
                </div>
                <div class="card-body">
                    @if (!empty($errors->all()))
                        <div class="row">
                            <div class="col">
                                <div class="alert pb-0 alert-danger alert-dismissible fade show fs-6" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('rekomendasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="id_siswa" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Alumni') }}
                            </label>
                            <div class="col-sm-8">
                                <select name="id_siswa[]" id="id_siswa"
                                    class="id_siswa form-control select2 select2-hidden-accessible" required multiple>
                                    @foreach ($alumni as $item)
                                        <option value="{{ $item->id_siswa }}">
                                            {{ $item->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="id_lowongan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Pilih Loker') }}
                            </label>
                            <div class="col-sm-8">
                                <select name="id_lowongan" id="id_lowongan" class="form-select id_lowongan" required>
                                    <option selected disabled hidden>-- Pilih Loker --</option>
                                    @foreach ($lowongan as $item)
                                        <option value="{{ $item->id_lowongan }}">
                                            {{ __("{$item->judul_lowongan} - {$item->posisi}") }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="judul" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Judul Pesan') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="judul" name="judul"
                                    placeholder="IT Consultant" required value="{{ old('judul') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="deskripsi" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Deskripsi') }}
                            </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required autocomplete="off">
                    {{ old('deskripsi') }}
                </textarea>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="automatic_msg" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                                {{ __('Gunakan pesan otomatis') }}
                            </label>
                            <div class="col-sm-8">
                                <input type="checkbox" class="form-check" id="automatic_msg" name="automatic_msg"
                                    value="true" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8 d-flex gap-2">
                                <button type="submit" class="btn custom-btn btn-primary">Tambah</button>
                                <a href="{{ route('rekomendasi.index') }}" class="btn custom-btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.id_siswa').select2({
                placeholder: '-- Pilih Alumni --',
            });
            $('.id_lowongan').select2();

            const autoMsg = document.querySelector('#automatic_msg');
            autoMsg.addEventListener('change', function() {
                const judul = document.querySelector('#judul');
                const deskripsi = document.querySelector('#deskripsi');

                if (this.checked) {
                    judul.setAttribute('readonly', true);
                    judul.setAttribute('disabled', true);
                    deskripsi.setAttribute('readonly', true);
                    deskripsi.setAttribute('disabled', true);
                } else {
                    judul.removeAttribute('readonly');
                    judul.removeAttribute('disabled');
                    judul.removeAttribute('required');
                    deskripsi.removeAttribute('readonly');
                    deskripsi.removeAttribute('disabled');
                    deskripsi.removeAttribute('required');
                }
            });
        });
    </script>
@endpush
