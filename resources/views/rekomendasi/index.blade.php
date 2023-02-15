@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Daftar Rekomendasi</h2>
    <a href="{{ route('rekomendasi.create') }}" class="btn btn-primary custom-btn">Tambah Rekomendasi</a>
  </div>

  <div class="row">
    <div class="col">
      <form action="{{ route('rekomendasi.index') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="custom-font form-control"
            placeholder="Cari berdasarkan nama alumni, posisi atau judul loker" name="q" autocomplete="off"
            id="q" value="{{ request('q') }}">
          <button class="custom-font btn btn-success d-flex align-items-center gap-2" type="submit" id="button-addon2">
            <span><i class="fa-solid fa-magnifying-glass fa-lg"></i></span>
            <span>Cari</span>
          </button>
        </div>
      </form>
    </div>
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
                Nama Alumni
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Judul Loker
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Posisi Loker
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($rekomendasi as $key => $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $rekomendasi->firstItem() + $key }}
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->nama_lengkap }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->judul_lowongan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->posisi }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div class="d-flex gap-2 align-items-center justify-content-center">
                    <form
                      action="{{ route('rekomendasi.delete', [
                          'siswa' => encrypt($item->id_siswa),
                          'lowongan' => encrypt($item->id_lowongan),
                      ]) }}"
                      method="post">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn custom-btn btn-danger">
                        <span><i class="fa-solid fa-trash fa-lg"></i></span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="fs-5 text-center">
                  <x-svg-empty-icon />
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div>{{ $rekomendasi->links() }}</div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    $(document).on("keypress", function() {
      $("#q").focus();
    });
  </script>
@endpush
