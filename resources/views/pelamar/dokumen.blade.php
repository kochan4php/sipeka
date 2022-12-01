@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row">
      <div class="col-md-4">
        <img src="{{ asset('assets/images/6.jpeg') }}" style="height: 290px; object-fit: cover; object-position: center"
          class="img-fluid d-block w-100 rounded" alt="...">
        <div class="btn-group-vertical w-100 mt-4">
          <a href="" class="btn btn-outline-dark btn-block fs-5">
            Profil saya
          </a>
          <a href="" class="btn bg-dark text-white btn-outline-dark btn-block fs-5">
            Dokumen saya
          </a>
          <a href="" class="btn btn-outline-dark btn-block fs-5">
            Progress pendaftaran lowongan saya
          </a>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card-header pb-0 d-flex align-items-center justify-content-between">
          <h3 class="mb-">Dokumen saya</h3>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary me-md-2" type="button">Upload</button>
            <button class="btn btn-primary" type="button">Ubah</button>
          </div>
        </div>
        <div id="tableDokumen_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
          <div class="row">
            <div class="col-sm-12 col-md-6"></div>
            <div class="col-sm-12 col-md-6"></div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <table id="tableDokumen"
                class="table table-bordered table-striped table-hover dataTable no-footer dtr-inline" role="grid"
                aria-describedby="tableDokumen_info">
                <thead>

                  <tr role="row">
                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="NAMA DOKUMEN">NAMA DOKUMEN
                    </th>
                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="STATUS UPLOAD"
                      style="width: 30%;">STATUS UPLOAD</th>
                    <th class="dt-nowrap sorting" tabindex="0" aria-controls="tableDokumen" rowspan="1"
                      colspan="1" aria-label="AKSI: activate to sort column ascending" style="width: 30%;">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <tr role="row" class="odd">
                    <td>KTP</td>
                    <td>Belum Upload</td>
                    <td class=" dt-nowrap"><a href="#"><button class="btn btn-sm btn-orange btnUpload"
                          attr-id="1"><i class="fas fa-upload"></i> Upload</button></a> </td>
                  </tr>
                  <tr role="row" class="even">
                    <td>Kartu Pencari Kerja</td>
                    <td>Belum Upload</td>
                    <td class=" dt-nowrap"><a href="#"><button class="btn btn-sm btn-orange btnUpload"
                          attr-id="2"><i class="fas fa-upload"></i> Upload</button></a> </td>
                  </tr>
                  <tr role="row" class="odd">
                    <td>Ijasah</td>
                    <td>Sudah Upload</td>
                    <td class=" dt-nowrap"><a href="#"><button class="btn btn-sm btn-green btnEdit" attr-id="3"
                          attr-id_dokumen="28"><i class="fas fa-upload"></i> Upload</button></a> <a href="#"><button
                          class="btn btn-sm btn-primary btnView" attr-id_dokumen="28"><i class="fa fa-search"
                            aria-hidden="true"></i> Lihat</button></a> </td>
                  </tr>
                  <tr role="row" class="even">
                    <td>Transkip Nilai</td>
                    <td>Belum Upload</td>
                    <td class=" dt-nowrap">
                      <a href="#">
                        <button class="btn btn-sm btn-orange btnUpload" attr-id="4">
                          <i class="fas fa-upload"></i>
                          Upload
                        </button>
                      </a>
                    </td>
                  </tr>
                  <tr role="row" class="odd">
                    <td>Surat Keterangan Catatan Kepolisian</td>
                    <td>Belum Upload</td>
                    <td class=" dt-nowrap"><a href="#"><button class="btn btn-sm btn-orange btnUpload"
                          attr-id="5"><i class="fas fa-upload"></i> Upload</button></a> </td>
                  </tr>
                </tbody>
              </table>
              <div id="tableDokumen_processing" class="dataTables_processing card" style="display: none;">Processing...
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
