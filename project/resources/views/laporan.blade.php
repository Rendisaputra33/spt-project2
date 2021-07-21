@extends('template.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data Laporan</h2>
                <div class="right d-flex align-items-center">

                    <button type="button" class="btn btn-gradient-success btn-icon h-100" data-target="#modal-md-filter" id='tbh' data-toggle="modal">
                        <i class="mdi mdi-filter-outline"></i>
                    </button>
                    {{-- &nbsp; &nbsp;
          <button type="button" class="btn btn-success btn-icon h-100" data-target="#modal-md-tambah" id='tbh' data-toggle="modal">
              <i class="mdi mdi-plus"></i>
          </button> --}}

                </div>

            </div>
            <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Beli</th>
                                    <th>HPP</th>
                                    <th>Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>dummy</td>
                                    <td>dummy</td>
                                    <td>dummy</td>
                                    <td>dummy</td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-sm btn-info btn-icon-text" data-target="#modal-lg-detail" id='tbh' data-toggle="modal">
                    <i class="mdi mdi-information-outline btn-icon-prepend"></i> Detail </button> --}}
                                        <button type="button" class="btn btn-sm btn-warning btn-icon-text">
                                            <i class="mdi mdi-lead-pencil btn-icon-prepend"></i> Ubah </button>
                                        <button type="button" class="btn btn-sm btn-danger btn-icon-text">
                                            <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Hapus </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates </a> from Bootstrapdash.com</span>
            </div>
        </footer>
    </div>
    <!-- modal untuk tambah data -->
    <div class="modal fade" id="modal-md-filter">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Filter</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group" id="tanggal">
                        <label for="exampleInputPassword1">Tanggal Awal</label>
                        <input type="date" class="form-control" name="tanggal" required>
                        <span class="text-dark"></span>
                    </div>
                    <div class="form-group" id="tanggal">
                        <label for="exampleInputPassword1">Tanggal Akhir</label>
                        <input type="date" class="form-control" name="tanggal" required>
                        <span class="text-dark"></span>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-gradient-success">Cari</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>

@endsection
