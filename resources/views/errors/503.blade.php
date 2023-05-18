@extends('errors.layouts', ['title' => '503 Maintenance Mode'])

@section('error')
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="not-found-title">503</h1>
                    <p class="fs-4 mb-1"><span class="text-danger">Sorry</span>, we are down for maintenance.</p>
                    <p>We will back shortly.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
