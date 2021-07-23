@extends('template.template')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 p-0 d-flex justify-content-between">
            <h2>Data Petani</h2>
            <div class="right d-flex align-items-center">
                <div class="input-group">
                    <input type="text" id="search" class="form-control form-control-sm" placeholder="Cari Data Petani.." aria-label="Cari Data Petani.." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-gradient-success" type="button">Cari</button>
                    </div>
                </div>
                &nbsp;
                <button type="button" class="btn btn-gradient-success btn-icon-text d-flex" data-target="#modal-md-tambah" id='tbh' data-toggle="modal">
                    <i class="mdi mdi-plus btn-icon-prepend"></i>Tambah
                </button>
            </div>

        </div>
        <div class="msg mt-2">
            @if (session('sukses') !== null)
            <x-alert type="success" message="{{ session('sukses') }}" icon="fas fa-check-circle" />
            @endif
            @if (session('error') !== null)
            <x-alert type="danger" message="{{ session('error') }}" />
            @endif
        </div>
        <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>REG</th>
                                <th>Nama Petani</th>
                                <th>Pabrik</th>
                                <!-- <th>Tanggal Masuk</th> -->
                            </tr>
                        </thead>
                        <tbody id="list">
                            <?php $no = 1; ?>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->reg }}</td>
                                <td>{{ $item->nama_petani }}</td>
                                <td>{{ $item->nama_pabrik === null ? 'Pabrik Dihapus' : $item->nama_pabrik }}</td>
                                <!-- <td>{{ date('d/M/Y', strtotime($item->created_at)) }}</td> -->
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-md-tambah" id='tbh' data-toggle="modal" data-id="{{ $item->id_petani }}"> <i class="mdi mdi-lead-pencil btn-icon-prepend"></i> Ubah </button>
                                    <a class="btn btn-sm btn-danger btn-icon-text delete" href="{{ url('/petani') . '/' . $item->id_petani }}"> <i class="mdi mdi-delete btn-icon-prepend"></i> Hapus </a>
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
<form action="{{ url('/petani') }}" method="post" id="form-">
    @csrf
    <div id="method"></div>
    <div class="modal fade" id="modal-md-tambah">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Ubah Data Barang</h3>

                    <button type="button" class="close" data-dismiss="modal" id="close-modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="reg">
                        <label for="exampleInputPassword1">REG</label>
                        <input type="text" class="form-control" placeholder="REG" name="register" required>
                        <span class="text-dark"></span>
                    </div>
                    <div class="form-group" id="nama_pemilik">
                        <label for="exampleInputPassword1">Nama Pemilik</label>
                        <input type="text" class="form-control" placeholder="Nama Pemilik" name="nama" required>
                        <span class="text-dark"></span>
                    </div>
                    <div class="form-group">
                        <label for="level">Pabrik</label>
                        <select class="form-control" name="pabrik" id="level" required>
                            <option selected value="">Pilih</option>
                            @foreach ($pabrik as $item)
                            <option value="{{ $item->id_pabrik }}">{{ $item->nama_pabrik }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-gradient-success">Simpan</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
@endsection
@section('specific-js')
<script src="{{ asset('assets/js/function/Petani.js') }}"></script>
@endsection