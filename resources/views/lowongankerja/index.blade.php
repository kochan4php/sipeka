@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h1>Lowongan Kerja</h1>
    <a href="{{ route('lowongankerja.create') }}" class="btn btn-primary custom-btn">Tambah Lowongan Kerja</a>
  </div>

  @can('admin')
    <div class="row my-3 gap-3 gap-md-0">
      <x-card-admin bgcolor="text-bg-warning">
        @slot('data')
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-3 fw-medium">Setujui Pelamar</span>
            <span><i class="fa-solid fa-user-check" style="font-size: 3rem"></i></span>
          </div>
        @endslot
        <a href="{{ route('admin.pelamar.index') }}" class="text-decoration-none stretched-link text-dark">
          <h4>Selengkapnya</h4>
        </a>
      </x-card-admin>
      <x-card-admin bgcolor="text-bg-info">
        @slot('data')
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-3 fw-medium">Setujui Lowongan Kerja</span>
            <span><i class="fa-solid fa-briefcase" style="font-size: 3rem"></i></span>
          </div>
        @endslot
        <a href="{{ route('lowongankerja.jobVacanciesThatRequireApproval') }}"
          class="text-decoration-none stretched-link text-dark d-flex gap-2 align-items-center">
          <h4>Selengkapnya</h4>
          @if ($lowonganNeedApprove > 0)
            <box-icon name="bell" type="solid" color="red"></box-icon>
          @endif
        </a>
      </x-card-admin>
      <x-card-admin bgcolor="text-bg-indigo">
        @slot('data')
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-3 fw-medium">Setujui Tahap Seleksi</span>
            <span><i class="fa-solid fa-clipboard-check" style="font-size: 3rem"></i></span>
          </div>
        @endslot
        <a href="{{ route('lowongankerja.jobVacanciesThatRequireApproval') }}"
          class="text-decoration-none stretched-link text-white d-flex gap-2 align-items-center">
          <h4>Selengkapnya</h4>
        </a>
      </x-card-admin>
    </div>
  @endcan

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table @if ($lowongan->count() > 0) id="myTable" @endif
          class="table table-bordered border-secondary table-striped py-2">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                No
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Judul Lowongan
              </th>
              @can('admin')
                <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                  Nama Perusahaan
                </th>
              @endcan
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Tanggal Dimulai
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Tanggal Berakhir
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Status
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Jumlah Tahapan
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($lowongan as $item)
              <tr class="@if ($item->tahapan_seleksi->count() === 0) no-tahapan @endif">
                <th
                  class="text-nowrap text-center vertical-align-middle custom-font @if ($item->tahapan_seleksi->count() === 0) bg-danger text-white @endif"
                  scope="row">
                  {{ $loop->iteration }}
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->judul_lowongan }}
                </td>
                @can('admin')
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ $item->perusahaan->nama_perusahaan }}
                  </td>
                @endcan
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ \Carbon\Carbon::parse($item->tanggal_dimulai)->format('d M Y') }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ \Carbon\Carbon::parse($item->tanggal_berakhir)->format('d M Y') }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  @if ($item->active)
                    {{ __('Aktif') }}
                  @else
                    {{ __('Non-Aktif') }}
                  @endif
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->tahapan_seleksi->count() }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div class="d-flex gap-2 align-items-center justify-content-center">
                    <a href="{{ route('lowongankerja.detail', $item->slug) }}"
                      class="btn btn-detail custom-btn btn-success">
                      <span><i class="fa-solid fa-circle-info fa-lg"></i></span>
                    </a>
                    <a href="{{ route('lowongankerja.edit', $item->slug) }}" class="btn btn-edit custom-btn btn-warning">
                      <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                    </a>
                    @if ($item->active)
                      <form action="{{ route('lowongankerja.nonactive', $item->slug) }}" method="post">
                        @csrf
                        <button type="submit" class="btn custom-btn btn-info btn-nonactive">
                          <span><i class="fa-solid fa-box-archive fa-lg"></i></span>
                        </button>
                      </form>
                    @endif
                    <a href="{{ route('tahapan.seleksi.detail_lowongan', $item->slug) }}"
                      class="btn custom-btn btn-primary btn-tahapan">
                      <span><i class="fa-solid fa-code-branch fa-lg"></i></span>
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="fs-5 text-center">
                  <x-svg-empty-icon />
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @push('script')
    <script>
      tippy('.btn-tahapan', {
        content: 'Tahapan Seleksi',
        placement: 'left'
      });
      tippy('.btn-nonactive', {
        content: 'Non-Aktifkan Lowongan',
        placement: 'left'
      });
      tippy('.btn-edit', {
        content: 'Edit data',
        placement: 'left'
      });
      tippy('.btn-detail', {
        content: 'Detail data',
        placement: 'left'
      });
      tippy('.no-tahapan', {
        content: 'Lowongan ini belum memiliki tahapan seleksi.',
        placement: 'bottom',
      });
    </script>
  @endpush
@endsection
