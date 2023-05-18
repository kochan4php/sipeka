<header
    class="navbar navbar-dark sticky-top bg-white bg-md-primary border-bottom border-2 border-secondary flex-md-nowrap p-0 d-flex justify-content-between align-items-center shadow-sm"
    style="--bs-border-opacity: .2;">
    <a class="navbar-brand bg-primary col-md-3 col-lg-2 me-0 px-3 fs-5 fw-bold"
        href="{{ route('admin.index') }}">{{ Auth::user()->level_user->nama_level }}</a>
    <a class="navbar-brand bg-transparent text-black col-md-3 d-none d-md-inline-block col-lg-2 me-0 px-3 fs-5 text-left fw-bold"
        href="{{ route('home') }}">SIPEKA {{ Auth::user()->level_user->nama_level }}</a>
    <button class="navbar-toggler position-absolute collapsed d-md-none" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <hr>
</header>
