@extends('template.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data Pembayaran</h2>
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
                                    <th>Invoice</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>

                                </tr>
                            </thead>
                            <tbody id="list">
                                <tr>
                                    <td>1</td>
                                    <td>dummy</td>
                                    <td>dummy</td>
                                    <td>dummy</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info btn-icon-text detail" data-target="#modal-lg-detail" id='tbh' data-toggle="modal" data-id="">
                                            <i class="mdi mdi-information-outline btn-icon-prepend"></i>Detail </button>
                                        <a href="{{ url('/entry') . '/' . $item->id_entry }}" class="btn btn-sm btn-danger btn-icon-text delete">
                                            <i class="mdi mdi-delete-forever btn-icon-prepend"></i>Hapus </a>
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
    <div id="method"></div>
    <div class="modal fade" id="modal-md-tambah">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Data Pengirim</h3>
                    <button type="button" class="close" data-dismiss="modal" id="close-modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="reg">
                        <label for="exampleInputPassword1">Nama Pengirim</label>
                        <input type="text" autocomplete="off" class="form-control" placeholder="Nama Pengirim" name="nama" required>
                        <span class="text-dark"></span>
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
    <script src="{{ asset('assets/js/function/pengirim.js') }}"></script>
@endsection
