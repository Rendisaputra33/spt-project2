
@extends('template.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
        <div class="col-lg-12 p-0 d-flex justify-content-between">
        <h2>Data PG</h2>
        <button type="button" class="btn btn-success btn-icon" data-target="#modal-md-tambah" id='tbh' data-toggle="modal">
            <i class="mdi mdi-plus"></i>
          </button>
        </div>
          <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama PG</th>
                        <th>Kode PG</th>
                        <th>Tanggal Masuk</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td>1</td>
                          <td>dummy</td>
                          <td>dummy</td>
                          <td>dummy</td>
                          <td>
                              <button type="button" class="btn btn-sm btn-warning btn-icon-text">
                                  <i class="mdi mdi-lead-pencil btn-icon-prepend"></i> Ubah </button>
                              <button type="button" class="btn btn-sm btn-danger btn-icon-text">
                                  <i class="mdi mdi-delete btn-icon-prepend"></i> Hapus </button>
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
    <form action="/berangkat" method="post">
        @csrf
        <div class="modal fade" id="modal-md-tambah">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Data PG</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="nama_pg">
                            <label for="exampleInputPassword1">Nama PG</label>
                            <input type="text" class="form-control" placeholder="Nama PG" name="nama_pg" required>
                            <span class="text-dark"></span>
                        </div>
                        <div class="form-group" id="kode_PG">
                            <label for="exampleInputPassword1">Kode PG</label>
                            <input type="text" class="form-control" placeholder="Kode PG" name="kode_PG" required>
                            <span class="text-dark"></span>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
</form>
@endsection