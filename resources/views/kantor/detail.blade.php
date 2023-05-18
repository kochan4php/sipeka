@extends('layouts.dashboard.app')

@section('container-dashboard')
    <div class="row pt-3 pb-1 mb-1">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <h2>Detail Data Kantor</h2>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-9">
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Nama Perusahaan') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __($kantor->perusahaan->nama_perusahaan) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Kategori Perusahaan') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __($kantor->perusahaan->kategori_perusahaan) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Wilayah Kantor') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __($kantor->wilayah_kantor) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Status Kantor') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __($kantor->status_kantor) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('No. Telp. Kantor') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __($kantor->no_telp_kantor) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Alamat Kantor') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                                        <td class="border-0 fs-5 fs-md-6">{{ __($kantor->alamat_kantor) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col">
                            <a href="{{ route('kantor.index') }}" class="btn custom-btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
