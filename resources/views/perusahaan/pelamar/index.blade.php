@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Data Pelamar</h2>
  </div>

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
                Foto
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Nama Pelamar
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Alumni / Kandidat Luar Sekolah
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody class="custom-font">
            @forelse ($pelamar as $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $loop->iteration }}
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  @if ($item->alumni)
                    @if (is_null($item->alumni->foto))
                      <img src="{{ Avatar::create($item->alumni->nama_lengkap) }}" alt="{{ $item->user->username }}"
                        width="40" class="rounded-circle">
                    @else
                      <img src="{{ asset('storage/' . $item->alumni->foto) }}" alt="{{ $item->user->username }}"
                        width="40">
                    @endif
                  @else
                    @if (is_null($item->masyarakat->foto))
                      <img src="{{ Avatar::create($item->masyarakat->nama_lengkap) }}" alt="{{ $item->user->username }}"
                        width="40" class="rounded-circle">
                    @else
                      <img src="{{ asset('storage/' . $item->masyarakat->foto) }}" alt="{{ $item->user->username }}"
                        width="40">
                    @endif
                  @endif
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->alumni ? $item->alumni->nama_lengkap : $item->masyarakat->nama_lengkap }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->alumni ? 'Alumni' : 'Kandidat Luar Sekolah' }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <a href="{{ route('perusahaan.pelamar.detail', $item->user->username) }}"
                    class="btn custom-btn btn-success btn-detail">
                    <span><i class="fa-solid fa-circle-info fa-lg"></i></span>
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="fs-5 text-center">Data pelamar belum ada!</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
