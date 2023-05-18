@extends('layouts.dashboard.app')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-1">
        <h2>Beranda</h2>
    </div>
    <div class="row gap-3 gap-md-0 mb-3">
        <x-card-admin bgcolor="text-bg-indigo">
            @slot('data')
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-bold leading-1px">{{ $jumlah_pengguna }}</span>
                    <span><i class="fa-solid fa-user" style="font-size: 3rem"></i></span>
                </div>
            @endslot
            <a href="{{ route('admin.pengguna.index') }}" class="text-decoration-none stretched-link text-white">
                <h5>Pengguna</h5>
            </a>
        </x-card-admin>
        <x-card-admin bgcolor="text-bg-danger">
            @slot('data')
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-bold leading-1px">{{ $jumlah_alumni }}</span>
                    <span><i class="fa-solid fa-user-graduate" style="font-size: 3rem"></i></span>
                </div>
            @endslot
            <a href="{{ route('admin.alumni.index') }}" class="text-decoration-none stretched-link text-white">
                <h5>Alumni</h5>
            </a>
        </x-card-admin>
        <x-card-admin bgcolor="text-bg-purple">
            @slot('data')
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-bold leading-1px">{{ $jumlah_masyarakat }}</span>
                    <span><i class="fa-solid fa-user" style="font-size: 3rem"></i></span>
                </div>
            @endslot
            <a href="{{ route('admin.pelamar.index') }}" class="text-decoration-none stretched-link text-white">
                <h5>Kandidat Luar Sekolah</h5>
            </a>
        </x-card-admin>
        <x-card-admin bgcolor="text-bg-pink">
            @slot('data')
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-bold leading-1px">{{ $jumlah_mitra_perusahaan }}</span>
                    <span><i class="fa-solid fa-building" style="font-size: 3rem"></i></span>
                </div>
            @endslot
            <a href="{{ route('admin.perusahaan.index') }}" class="text-decoration-none stretched-link text-white">
                <h5>Perusahaan</h5>
            </a>
        </x-card-admin>
        <x-card-admin bgcolor="text-bg-orange">
            @slot('data')
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-bold leading-1px">{{ $jumlah_lowongan }}</span>
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 3rem"></i>
                </div>
            @endslot
            <a href="{{ route('lowongankerja.index') }}" class="text-decoration-none stretched-link text-white">
                <h5>Loker Aktif</h5>
            </a>
        </x-card-admin>
        <x-card-admin bgcolor="text-bg-success">
            @slot('data')
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-medium">Penelusuran Alumni</span>
                    <span><i class="fa-solid fa-user-graduate" style="font-size: 3rem"></i></span>
                </div>
            @endslot
            <a href="{{ route('admin.pelamar.index') }}" class="text-decoration-none stretched-link text-white">
                <h5>Selengkapnya</h5>
            </a>
        </x-card-admin>
        <x-card-admin bgcolor="text-bg-warning">
            @slot('data')
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-medium">Setujui Pelamar</span>
                    <span><i class="fa-solid fa-user-check" style="font-size: 3rem"></i></span>
                </div>
            @endslot
            <a href="{{ route('admin.pelamar.index') }}" class="text-decoration-none stretched-link text-dark">
                <h5>Selengkapnya</h5>
            </a>
        </x-card-admin>
        <x-card-admin bgcolor="text-bg-info">
            @slot('data')
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-medium">Setujui Lowongan Kerja</span>
                    <span><i class="fa-solid fa-briefcase" style="font-size: 3rem"></i></span>
                </div>
            @endslot
            <a href="{{ route('lowongankerja.jobVacanciesThatRequireApproval') }}"
                class="text-decoration-none stretched-link text-dark d-flex gap-2 align-items-center">
                <h5>Selengkapnya</h5>
            </a>
        </x-card-admin>
        <x-card-admin bgcolor="text-bg-primary">
            @slot('data')
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-medium">Setujui Tahap Seleksi</span>
                    <span><i class="fa-solid fa-clipboard-check" style="font-size: 3rem"></i></span>
                </div>
            @endslot
            <a href="{{ route('lowongankerja.jobVacanciesThatRequireApproval') }}"
                class="text-decoration-none stretched-link text-white d-flex gap-2 align-items-center">
                <h5>Selengkapnya</h5>
            </a>
        </x-card-admin>
    </div>
    {{-- <div class="row gap-3 mb-3 padding">
    <div class="bg-white rounded-3 p-4 border border-secondary">
      <div class="d-flex align-items-center mb-3">
        <h4 class="fw-bold me-2 mb-0">Grafik Karir Alumni </h4>
      </div>
      <canvas id="myChart"></canvas>
    </div>
  </div> --}}
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Nigga', 'Cina'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3, 100, 50],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
