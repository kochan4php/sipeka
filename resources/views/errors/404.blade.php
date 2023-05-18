@extends('errors.layouts', ['title' => '404 Page Not Found'])

@section('error')
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="not-found-title">404</h1>
                    <p class="fs-4 mb-1"><span class="text-danger">Opps!</span> Halaman tidak ditemukan.</p>
                    <p>Halaman yang kamu tuju mungkin tidak ada.</p>
                    <a href="{{ route('home') }}" class="btn custom-btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
