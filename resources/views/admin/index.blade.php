@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-1">
    <h2>Beranda</h2>
  </div>
  <div class="row gap-3 gap-md-0 mb-3">
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-info">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">3712</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
              class="bi bi-person-vcard" viewBox="0 0 16 16">
              <path
                d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
              <path
                d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
            </svg>
          </div>
          <div class="mt-4">
            <h4>Jumlah Pengguna</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-warning">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">456</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
              class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
              <path
                d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z" />
              <path
                d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z" />
            </svg>
          </div>
          <div class="mt-4">
            <h4>Jumlah Masyarakat</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-secondary">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">3231</span>
            <span data-feather="users" class="size-48"></span>
          </div>
          <div class="mt-4">
            <h4>Jumlah Alumni</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-indigo">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">25</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
              class="bi bi-building" viewBox="0 0 16 16">
              <path
                d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z" />
              <path
                d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1Z" />
            </svg>
          </div>
          <div class="mt-4">
            <h4>Jumlah Perusahaan</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-danger">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">20</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
              class="bi bi-person-vcard" viewBox="0 0 16 16">
              <path
                d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
              <path
                d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
            </svg>
          </div>
          <div class="mt-4">
            <h4>Jumlah Jurusan</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-success">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">5967</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
              class="bi bi-person-vcard" viewBox="0 0 16 16">
              <path
                d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
              <path
                d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
            </svg>
          </div>
          <div class="mt-4">
            <h4>Jumlah Angkatan</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
