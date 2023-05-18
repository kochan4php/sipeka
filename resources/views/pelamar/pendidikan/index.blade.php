@extends('layouts.app')

@section('container')
    <div class="container mb-5" style="margin-top: 120px;">
        <div class="row gap-4 gap-md-0">
            @include('pelamar.action')
            <div class="col-lg-9">
                <x-alert-session />
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3>Pendidikan Saya</h3>
                        <a href="{{ route('pelamar.pendidikan.add', Auth::user()->username) }}"
                            class="btn custom-btn btn-primary" type="button">Tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 d-flex flex-column gap-3">
                                @forelse ($pendidikan as $pdnk)
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h5>{{ $pdnk->institut_or_universitas }}</h5>
                                                    <h6 class="text-muted">{{ $pdnk->tahun_kelulusan }}</h6>
                                                    <div class="d-flex gap-2">
                                                        <span>{{ $pdnk->gelar_pendidikan->nama_gelar }}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('pelamar.experience.edit', ['username' => Auth::user()->username, 'id' => $pdnk->id_riwayat]) }}"
                                                            class="btn custom-btn btn-warning">
                                                            <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                                                        </a>
                                                        <form
                                                            action="{{ route('pelamar.experience.delete', ['username' => Auth::user()->username, 'id' => $pdnk->id_riwayat]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn custom-btn btn-danger">
                                                                <span><i class="fa-solid fa-trash fa-lg"></i></span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="card">
                                        <div class="card-body custom-font text-center">
                                            Kamu belum memiliki data pendidikan.
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
