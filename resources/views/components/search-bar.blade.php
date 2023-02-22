<div class="row">
  <div class="col">
    <form action="{{ $action }}">
      @csrf
      <div class="input-group mb-3">
        <input type="text" class="custom-font form-control" placeholder="{{ $placeholder }}" name="q"
          autocomplete="off" id="q" value="{{ request('q') }}" autofocus>
        <button class="custom-font btn btn-success d-flex align-items-center gap-2" type="submit" id="button-addon2">
          <span><i class="fa-solid fa-magnifying-glass fa-lg"></i></span>
          <span>Cari</span>
        </button>
      </div>
    </form>
  </div>
</div>
