@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h3>Data Lowongan Kerja</h3>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table class="table table-bordered border-secondary border-1 table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                No
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Judul Lowongan
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Tanggal Dimulai
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Tanggal Berakhir
              </th>
              @can('admin')
                <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                  Nama Perusahaan
                </th>
              @endcan
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Jumlah Tahapan Seleksi
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($lowongan as $item)
              <tr class="@if ($item->tahapan_seleksi->count() === 0) no-tahapan @endif">
                <th
                  class="text-nowrap text-center vertical-align-middle custom-font @if ($item->tahapan_seleksi->count() === 0) bg-danger text-white @endif"
                  scope="row">
                  {{ $loop->iteration }}.
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->judul_lowongan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ \Carbon\Carbon::parse($item->tanggal_dimulai)->format('d M Y') }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ \Carbon\Carbon::parse($item->tanggal_berakhir)->format('d M Y') }}
                </td>
                @can('admin')
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ $item->perusahaan->nama_perusahaan }}
                  </td>
                @endcan
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->tahapan_seleksi->count() }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <a href="{{ route('tahapan.seleksi.detail_lowongan', $item->slug) }}"
                    class="btn btn-primary custom-btn">
                    <i class="fa-solid fa-circle-info fa-lg"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @push('script')
    <script>
      tippy('.no-tahapan', {
        content: 'Lowongan ini belum memiliki tahapan seleksi.',
        placement: 'bottom',
      });
    </script>
  @endpush
@endsection
