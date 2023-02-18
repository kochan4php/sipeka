@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Setujui Tahapan Seleksi</h2>
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
                Nama Tahapan
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Tanggal Dilaksanakan
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Nama Loker
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Nama Mitra
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($tahapan as $key => $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $tahapan->firstItem() + $key }}
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->judul_tahapan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->tanggal_dimulai }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->lowongan->judul_lowongan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->lowongan->perusahaan->nama_perusahaan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div class="d-flex gap-2 align-items-center justify-content-center">
                    <form action="{{ route('tahapan.seleksi.reject', $item->id_tahapan) }}" method="post">
                      @csrf
                      <button type="submit" class="btn custom-btn btn-danger btn-reject">
                        <span><i class="fa-solid fa-x fa-lg"></i></span>
                      </button>
                    </form>
                    <form action="{{ route('tahapan.seleksi.approve', $item->id_tahapan) }}" method="post">
                      @csrf
                      <button type="submit" class="btn custom-btn btn-primary btn-approve">
                        <span><i class="fa-solid fa-check fa-lg"></i></span>
                      </button>
                    </form>
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
        <div>{{ $tahapan->links() }}</div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    tippy('.btn-danger', {
      content: 'Tolak Tahapan Seleksi',
      placement: 'left'
    });
    tippy('.btn-approve', {
      content: 'Setujui Tahapan Seleksi',
      placement: 'left'
    });
  </script>
@endpush
