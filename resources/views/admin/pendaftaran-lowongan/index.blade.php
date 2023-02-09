@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Setujui Pelamar</h2>
  </div>

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
                Nama Pelamar
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Alumni / Kandidat Luar Sekolah
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Nama Perusahaan
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Nama Loker
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Posisi
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pendaftaranLowongan as $key => $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $pendaftaranLowongan->firstItem() + $key }}
                </th>
                @if (!is_null($item->pelamar->alumni))
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ $item->pelamar->alumni->nama_lengkap }}
                  </td>
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ __('Alumni') }}
                  </td>
                @else
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ $item->pelamar->masyarakat->nama_lengkap }}
                  </td>
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ __('Kandidat Luar Sekolah') }}
                  </td>
                @endif
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->lowongan->perusahaan->nama_perusahaan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->lowongan->judul_lowongan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->lowongan->posisi }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div class="d-flex gap-2 align-items-center justify-content-center">
                    <a href="{{ route('admin.pendaftaran-lowongan.reject', $item->id_pendaftaran) }}"
                      class="btn custom-btn btn-danger btn-reject">
                      <span><i class="fa-solid fa-x fa-lg"></i></span>
                    </a>
                    <a href="{{ route('admin.pendaftaran-lowongan.approve', $item->id_pendaftaran) }}"
                      class="btn custom-btn btn-primary btn-approve">
                      <span><i class="fa-solid fa-check fa-lg"></i></span>
                    </a>
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
        <div>{{ $pendaftaranLowongan->links() }}</div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    tippy('.btn-danger', {
      content: 'Tolak Pelamar',
      placement: 'left'
    });
    tippy('.btn-approve', {
      content: 'Setujui Pelamar',
      placement: 'left'
    });
  </script>
@endpush
