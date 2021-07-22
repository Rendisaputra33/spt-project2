@extends('template.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data Transaksi</h2>
                <div class="right d-flex align-items-center">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Cari Data Petani.." aria-label="Cari Data Petani.." aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-gradient-success" type="button">Cari</button>
                        </div>
                    </div>
                    &nbsp;
                    <button type="button" class="btn btn-gradient-success btn-icon-text d-flex" data-target="#modal-lg-tambah" id='tbh' data-toggle="modal">
                        <i class="mdi mdi-plus btn-icon-prepend"></i>Tambah
                    </button>
                </div>

            </div>
            <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Masa Giling</th>
                                    <th>Periode</th>
                                    <th>Tanggal</th>
                                    <th>REG</th>
                                    <th>Tanggal Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->masa_giling }}</td>
                                        <td>{{ $item->periode }}</td>
                                        <td>{{ date('d/M/Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->reg }}</td>
                                        <td>{{ $item->nospta }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info btn-icon-text" data-target="#modal-lg-detail" id='tbh' data-toggle="modal">
                                                <i class="mdi mdi-information-outline btn-icon-prepend"></i> Detail </button>
                                            <button type="button" class="btn btn-sm btn-warning btn-icon-text update" data-id="{{ $item->id_entry }}">
                                                <i class="mdi mdi-lead-pencil btn-icon-prepend"></i> Ubah </button>
                                            <a href="{{ url('/entry') . '/' . $item->id_entry }}" class="btn btn-sm btn-danger btn-icon-text">
                                                <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Hapus </a>
                                        </td>
                                    </tr>
                                @endforeach
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
        <div class="modal fade" id="modal-lg-tambah">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Data User</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="col-lg-12 d-flex">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="level">Periode</label>
                                    <select class="form-control" name="Periode" id="periode" required>
                                        <option selected value="">Pilih</option>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="level">Masa Giling</label>
                                    <select class="form-control" name="masa_giling" id="masa_giling" required>
                                        <option selected value="">Pilih</option>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="level">REG</label>
                                    <select class="form-control" name="reg" id="reg" required>
                                        <option selected value="">Pilih</option>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="form-group" id="nospta">
                                    <label for="exampleInputPassword1">No SPTA</label>
                                    <input type="text" class="form-control" name="nospta" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="nopol">
                                    <label for="exampleInputPassword1">No POL</label>
                                    <input type="text" class="form-control" name="nopol" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="bobot">
                                    <label for="exampleInputPassword1">Bobot</label>
                                    <input type="text" class="form-control" name="bobot" required>
                                    <span class="text-dark"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group" id="keterangan">
                                    <label for="exampleInputPassword1">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="harga_beli">
                                    <label for="exampleInputPassword1">Harga Beli</label>
                                    <input type="text" class="form-control" name="harga_beli" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="hpp">
                                    <label for="exampleInputPassword1">HPP</label>
                                    <input type="text" class="form-control" name="hpp" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group">
                                    <label for="sisa">Sisa</label>
                                    <select class="form-control" name="sisa" id="sisa" required>
                                        <option selected value="">Pilih</option>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="form-group" id="tanggal">
                                    <label for="exampleInputPassword1">Tanggal</label>
                                    <input type="text" class="form-control" name="tanggal" required>
                                    <span class="text-dark"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-gradient-success">Simpan</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
    </form>
    <!-- modal untuk tambah data -->
    <div class="modal fade" id="modal-lg-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Detail</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

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
@endsection
