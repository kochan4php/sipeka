@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>
      <span>
        Data Kantor
      </span>
      @can('perusahaan')
        <span>
          {{ $dataMitra->nama_perusahaan }}
        </span>
      @endcan
    </h2>
    <a href="{{ route('kantor.create') }}" class="btn btn-primary custom-btn">
      Tambah Data Kantor
    </a>
  </div>

  @can('admin')
    @if (\App\Models\MitraPerusahaan::count() === 0)
      <div class="alert alert-warning custom-font">
        Data Mitra Perusahaan masih kosong. Untuk menambah data kantor, maka data mitra harus ada terlebih dahulu.
      </div>
    @else
      <div class="alert alert-warning custom-font">
        Untuk menambah data kantor, maka data mitra harus ada terlebih dahulu.
      </div>
    @endif
  @endcan

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table @if ($kantor->count() > 0) id="myTable" @endif
          class="table table-bordered border-secondary table-striped py-2">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                No
              </th>
              @can('admin')
                <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                  Nama Perusahaan
                </th>
              @endcan
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Status Kantor
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Wilayah Kantor
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Kantor Utama
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($kantor as $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $loop->iteration }}
                </th>
                @can('admin')
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ $item->perusahaan->nama_perusahaan }}
                  </td>
                @endcan
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->status_kantor }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->wilayah_kantor }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  @if ($item->kantor_utama)
                    <i class="fa-solid fa-check fa-lg"></i>
                  @else
                    <i class="fa-solid fa-x fa-lg"></i>
                  @endif
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div class="d-flex gap-2 align-items-center justify-content-center">
                    <a href="{{ route('kantor.detail', $item->id_kantor) }}" class="btn custom-btn btn-success">
                      <span><i class="fa-solid fa-circle-info fa-lg"></i></span>
                    </a>
                    <a href="{{ route('kantor.edit', $item->id_kantor) }}" class="btn custom-btn btn-warning">
                      <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                    </a>
                    <form action="{{ route('kantor.delete', $item->id_kantor) }}" method="post">
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
                <td colspan="5" class="fs-5 text-center">
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
