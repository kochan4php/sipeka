@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Daftar Akun</h2>
  </div>

  <x-search-bar :action="route('admin.pengguna.index')" placeholder="Cari berdasarkan username, level atau email" />

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
                Username
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Email
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">
                Level
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $key => $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $users->firstItem() + $key }}
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->username }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->email ?? __('-') }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  @if ($item->level_user->nama_level === 'Pelamar')
                    @if ($item->pelamar?->alumni)
                      {{ __('Alumni') }}
                    @else
                      {{ __('Kandidat Luar') }}
                    @endif
                  @else
                    {{ $item->level_user->nama_level }}
                  @endif
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
        <div>{{ $users->links() }}</div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script src="{{ asset('assets/js/autoFocusSearchBar.js') }}"></script>
@endpush
