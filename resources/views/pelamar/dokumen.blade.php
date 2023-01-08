@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-xl-0">
      @include('pelamar.action')
      <div class="col-lg-9">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3>Dokumen saya</h3>
            <div class="gap-2 d-flex justify-content-md-end">
              <button class="btn btn-primary custom-btn" type="button">Upload</button>
              <button class="btn btn-primary custom-btn" type="button">Ubah</button>
            </div>
          </div>
          <div id="tableDokumen_wrapper" class="card-body pb-0">
            <div class="row">
              <div class="col-sm-12 table-responsive">
                <x-alert-session />
                <table id="tableDokumen" class="table table-bordered border-dark">
                  <thead class="table-dark">
                    <tr role="row">
                      <th
                        class="text-nowrap text-center vertical-align-middle d-flex justify-content-center align-items-center gap-2">
                        <span>NAMA DOKUMEN</span>
                        <span>
                          <a href="#" type="button" class="text-white text-decoration-none p-2"
                            data-bs-toggle="modal" data-bs-target="#modalPetunjuk">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                              class="bi bi-question-circle" viewBox="0 0 16 16">
                              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                              <path
                                d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                            </svg>
                          </a>
                        </span>
                      </th>
                      <th class="text-nowrap text-center vertical-align-middle">
                        AKSI
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($jenisDokumen as $item)
                      <tr role="row" class="odd">
                        <td class="text-nowrap text-center vertical-align-middle">
                          <div class="d-flex align-items-center gap-2 justify-content-center">
                            <span>{{ $item->nama_dokumen }}</span>
                            @foreach ($dokumen as $dkmn)
                              @if ($dkmn->id_jenis_dokumen === $item->id_jenis_dokumen)
                                <span>
                                  <i class="fa-solid fa-check fa-lg text-success"></i>
                                </span>
                              @endif
                            @endforeach
                          </div>
                        </td>
                        <td class="text-nowrap text-center vertical-align-middle">
                          <button class="btn custom-btn btn-primary btn-upload" data-bs-toggle="modal"
                            data-bs-target="#modalUpload" data-jenis-dokumen="{{ $item->id_jenis_dokumen }}"
                            data-nama-dokumen="{{ $item->nama_dokumen }}" data-username="{{ Auth::user()->username }}">
                            <i class="fas fa-upload"></i>
                            <span>Upload</span>
                          </button>
                          @foreach ($dokumen as $dkmn)
                            @if ($dkmn->id_jenis_dokumen === $item->id_jenis_dokumen)
                              <a href="#">
                                <button class="btn custom-btn btn-success">
                                  <i class="fas fa-eye"></i>
                                  <span>Lihat</span>
                                </button>
                              </a>
                            @endif
                          @endforeach
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="modalUploadLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="labelModalUpload">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-modal" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            @csrf
            <div class="mb-3">
              <label for="formFile" class="form-label">Upload file</label>
              <input class="form-control" type="file" id="formFile" name="file" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn custom-btn btn-danger btn-cancel" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn custom-btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <x-modal-petunjuk-dokumen>
    Jika pada kolom NAMA DOKUMEN di profil kamu terdapat icon centang hijau &#40; <span>
      <i class="fa-solid fa-check fa-lg text-success"></i>
    </span>&#41;&#791; artinya kamu sudah mengupload dokumen tersebut.
  </x-modal-petunjuk-dokumen>

  @push('script')
    <script>
      const btnUpload = document.querySelectorAll('.btn-upload');
      btnUpload.forEach(btn => {
        btn.addEventListener('click', () => {
          const formModal = document.querySelector('.form-modal');
          const formLabel = document.querySelector('.form-modal .form-label');
          const btnClose = document.querySelector('.btn-close');
          const btnCancel = document.querySelector('.btn-cancel');
          const formLabelText = formLabel.textContent;

          const namaDokumen = btn.dataset.namaDokumen;
          const jenisDokumen = btn.dataset.jenisDokumen;
          const username = btn.dataset.username;
          const route = "{{ route('pelamar.dokumen.store', ['username' => ':username', 'dokumen' => ':dokumen']) }}"
            .replace(':username', username)
            .replace(':dokumen', jenisDokumen);

          formLabel.textContent = `${formLabelText} ${namaDokumen}`;
          formModal.setAttribute('action', route);

          const removeActionAttr = () => formModal.removeAttribute('action');
          btnClose.addEventListener('click', removeActionAttr);
          btnCancel.addEventListener('click', removeActionAttr);
        });
      });
    </script>
  @endpush
@endsection
