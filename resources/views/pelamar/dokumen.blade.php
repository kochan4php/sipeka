@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-">Dokumen saya</h3>
            <div class="gap-2 d-flex justify-content-md-end">
              <button class="btn btn-primary btn-sm" type="button">Upload</button>
              <button class="btn btn-primary btn-sm" type="button">Ubah</button>
            </div>
          </div>
          <div id="tableDokumen_wrapper" class="card-body pb-0">
            <div class="row">
              <div class="col-sm-12 table-responsive">
                <table id="tableDokumen"
                  class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline" role="grid"
                  aria-describedby="tableDokumen_info">
                  <thead>
                    <tr role="row">
                      <th class="text-nowrap" rowspan="1" colspan="1" aria-label="NAMA DOKUMEN">NAMA DOKUMEN
                      </th>
                      <th class="text-nowrap" rowspan="1" colspan="1" aria-label="STATUS UPLOAD"
                        style="width: 30%;">
                        STATUS UPLOAD</th>
                      <th class="text-nowrap" tabindex="0" aria-controls="tableDokumen" rowspan="1" colspan="1"
                        style="width: 30%;">AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr role="row" class="odd">
                      <td>KTP</td>
                      <td>Belum Upload</td>
                      <td class="d-flex gap-2">
                        <a href="#">
                          <button class="btn btn-sm btn-primary btnUpload" attr-id="1">
                            <i class="fas fa-upload"></i>
                            <span>Upload</span>
                          </button>
                        </a>
                        <a href="#">
                          <button class="btn btn-sm btn-success btnUpload">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                          </button>
                        </a>
                      </td>
                    </tr>
                    <tr role="row" class="even">
                      <td>Kartu Pencari Kerja</td>
                      <td>Belum Upload</td>
                      <td class="d-flex gap-2">
                        <a href="#">
                          <button class="btn btn-sm btn-primary btnUpload" attr-id="1">
                            <i class="fas fa-upload"></i>
                            <span>Upload</span>
                          </button>
                        </a>
                        <a href="#">
                          <button class="btn btn-sm btn-success btnUpload">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                          </button>
                        </a>
                      </td>
                    </tr>
                    <tr role="row" class="odd">
                      <td>Ijasah</td>
                      <td>Sudah Upload</td>
                      <td class="d-flex gap-2">
                        <a href="#">
                          <button class="btn btn-sm btn-primary btnUpload" attr-id="1">
                            <i class="fas fa-upload"></i>
                            <span>Upload</span>
                          </button>
                        </a>
                        <a href="#">
                          <button class="btn btn-sm btn-success btnUpload">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                          </button>
                        </a>
                      </td>
                    </tr>
                    <tr role="row" class="even">
                      <td>Transkip Nilai</td>
                      <td>Belum Upload</td>
                      <td class="d-flex gap-2">
                        <a href="#">
                          <button class="btn btn-sm btn-primary btnUpload" attr-id="1">
                            <i class="fas fa-upload"></i>
                            <span>Upload</span>
                          </button>
                        </a>
                        <a href="#">
                          <button class="btn btn-sm btn-success btnUpload">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                          </button>
                        </a>
                      </td>
                    </tr>
                    <tr role="row" class="odd">
                      <td>Surat Keterangan Catatan Kepolisian</td>
                      <td>Belum Upload</td>
                      <td class="d-flex gap-2">
                        <a href="#">
                          <button class="btn btn-sm btn-primary btnUpload" attr-id="1">
                            <i class="fas fa-upload"></i>
                            <span>Upload</span>
                          </button>
                        </a>
                        <a href="#">
                          <button class="btn btn-sm btn-success btnUpload">
                            <i class="fas fa-eye"></i>
                            <span>Lihat</span>
                          </button>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
