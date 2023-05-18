@if (!empty($errors->all()))
    <div class="row">
        <div class="col">
            <div class="alert pb-0 alert-danger alert-dismissible fade show custom-font" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
