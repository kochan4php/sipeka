@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h1>Loker ini membutuhkan persetujuan</h1>
  </div>

  <x-alert-session />

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
                Judul Lowongan
              </th>
              @can('admin')
                <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                  Nama Perusahaan
                </th>
              @endcan
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
                    <a href="{{ route('lowongankerja.rejectJobVancancies', $item->slug) }}"
                      class="btn btn-detail custom-btn btn-danger btn-not-approve">
                      <span><i class="fa-solid fa-x fa-lg"></i></span>
                    </a>
                    <a href="{{ route('lowongankerja.approveJobVancancies', $item->slug) }}"
                      class="btn btn-detail custom-btn btn-success btn-lets-approve">
                      <span><i class="fa-solid fa-check fa-lg"></i></span>
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
@endsection

@push('script')
  <script>
    tippy('.btn-not-approve', {
      content: 'Tolak',
      placement: 'left'
    });
    tippy('.btn-lets-approve', {
      content: 'Setujui',
      placement: 'left'
    });
  </script>
@endpush
