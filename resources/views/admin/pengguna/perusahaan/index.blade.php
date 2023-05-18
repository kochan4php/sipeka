@extends('layouts.dashboard.app')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
        <h2>Data Perusahaan</h2>
        <a href="{{ route('admin.perusahaan.create') }}" class="btn btn-primary custom-btn">
            Tambah Data Perusahaan
        </a>
    </div>

    <x-search-bar :action="route('admin.perusahaan.index')" placeholder="Cari berdasarkan nama mitra" />

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
                                Nama Perusahaan
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                Username Perusahaan
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                Email Perusahaan
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                Jumlah Kantor
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                Wilayah Kantor Utama
                            </th>
                            <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($perusahaan as $key => $item)
                            <tr>
                                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                                    {{ $perusahaan->firstItem() + $key }}
                                </th>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                    {{ $item->nama_perusahaan }}
                                </td>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                    {{ $item->user->username }}
                                </td>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                    {{ $item->user->email }}
                                </td>
                                @if ($item->kantor()->exists())
                                    <td class="text-nowrap text-center vertical-align-middle custom-font">
                                        {{ $item->kantor->count() }}
                                    </td>
                                    <td class="text-nowrap text-center vertical-align-middle custom-font">
                                        {{ $item->kantor->firstWhere('kantor_utama', true)?->wilayah_kantor ?? __('-') }}
                                    </td>
                                @else
                                    <td class="text-nowrap text-center vertical-align-middle custom-font">
                                        {{ __('-') }}
                                    </td>
                                    <td class="text-nowrap text-center vertical-align-middle custom-font">
                                        {{ __('-') }}
                                    </td>
                                @endif
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                    <div class="d-flex gap-2 align-items-center justify-content-center">
                                        <a href="{{ route('admin.perusahaan.detail', $item->user->username) }}"
                                            class="btn custom-btn btn-success">
                                            <span><i class="fa-solid fa-circle-info fa-lg"></i></span>
                                        </a>
                                        <a href="{{ route('admin.perusahaan.edit', $item->user->username) }}"
                                            class="btn custom-btn btn-warning">
                                            <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                                        </a>
                                        <a href="{{ route('admin.perusahaan.edit', $item->user->username) }}"
                                            class="btn custom-btn btn-primary">
                                            <span><i class="fa-solid fa-building fa-lg"></i></span>
                                        </a>
                                        @if ($item->is_blocked)
                                            <form action="{{ route('admin.perusahaan.unblock', $item->user->username) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn custom-btn btn-info btn-unblock">
                                                    <span><i class="fa-solid fa-unlock fa-lg"></i></span>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.perusahaan.block', $item->user->username) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn custom-btn btn-danger btn-block">
                                                    <span><i class="fa-solid fa-skull-crossbones fa-lg"></i></span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="fs-5 text-center">
                                    <x-svg-empty-icon />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>{{ $perusahaan->links() }}</div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/autoFocusSearchBar.js') }}"></script>
    <script>
        tippy('.btn-block', {
            content: 'Block Mitra',
            placement: 'bottom',
        });
        tippy('.btn-unblock', {
            content: 'Unblock Mitra',
            placement: 'bottom',
        });
    </script>
@endpush
