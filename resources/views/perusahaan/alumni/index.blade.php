@extends('layouts.dashboard.app')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
        <h2>Data Alumni</h2>
    </div>

    <x-search-bar :action="route('perusahaan.alumni.index')" placeholder="Cari berdasarkan nama, nis atau jurusan" />

    <div class="row">
        <div class="col table-responsive">
            <div class="table-responsive pb-2">
                <table class="table table-bordered border-secondary table-striped py-2">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                No
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                Nama Alumni
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                NIS / Username Alumni
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                Jurusan
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                Angkatan
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="custom-font">
                        @forelse ($alumni as $key => $item)
                            <tr>
                                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                                    {{ $alumni->firstItem() + $key }}
                                </th>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                    {{ $item->nama_lengkap }}
                                </td>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                    {{ $item->username }}
                                </td>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                    {{ $item->nama_jurusan }}
                                </td>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                    {{ $item->angkatan_tahun }}
                                </td>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                    <a href="{{ route('perusahaan.alumni.detail', $item->username) }}"
                                        class="btn custom-btn btn-success btn-detail">
                                        <span><i class="fa-solid fa-circle-info fa-lg"></i></span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="fs-5 text-center">Data alumni belum ada!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>{{ $alumni->links() }}</div>
            </div>
        </div>
    </div>
@endsection
