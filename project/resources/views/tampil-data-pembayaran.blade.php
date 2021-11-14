@extends('template.template')
<style>
    #loader {
        width: 100%;
        height: 100%;
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgb(88, 88, 88);
        opacity: 0.7;
        z-index: 9999;
    }

    #loader-2 {
        width: 100%;
        height: 100%;
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgb(88, 88, 88);
        opacity: 0.7;
        z-index: 9999;
    }

</style>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data Pembayaran</h2>

                <div class="right d-flex align-items-center">
                    <div class="input-group">
                        <input type="text" name="search-pem" class="form-control form-control text-dark-sm" placeholder="Cari Data Petani.." aria-label="Cari Data Petani.." aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-success" type="button">Cari</button>
                        </div>
                    </div>

                    &nbsp;
                    <a href="{{ url('/pembayaran/transaksi/cek-harga') }}" class="btn btn-success btn-icon-text d-flex">
                        <i class="mdi mdi-clipboard-text btn-icon-prepend"></i>Tambah
                    </a>
                    &nbsp;
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
                    <div id="loader-2" style="display: none;">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-light" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <span style="color: white; margin-top: 10px;">Loading...</span>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-6 right d-flex align-items-center p-0">
                            <div class="input-group" id="filter">
                                <input type="date" class="form-control text-dark" name="tgl1" value="{{ date('Y-m') . '-01' }}" required>
                                <input type="date" class="form-control text-dark" name="tgl2" value="{{ date('Y-m-d') }}" required>
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-success" data-page="pembayaran" name="filter" type="button">Filter</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover mt-5">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Pengirim</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="list-data">
                                @foreach ($pembayaran as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->invoice }}</td>
                                        <td>{{ date('d/m/Y', strtotime($item->creates)) }}</td>
                                        <td>{{ $item->pengirim }}</td>
                                        <td>Rp. {{ number_format($item->totals, 0, ',', '.') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info btn-icon-text detail" data-target="#modal-lg-detail" id='tbh' data-toggle="modal" data-id="{{ str_replace('/', '-', $item->invoice) }}">
                                                <i class="mdi mdi-information-outline btn-icon-prepend"></i>Detail
                                            </button>
                                            <a href="{{ url('/pembayaran') . '/' . str_replace('/', '-', $item->invoice) }}" class="btn btn-sm btn-danger btn-icon-text delete">
                                                <i class="mdi mdi-delete-forever btn-icon-prepend"></i>Hapus
                                            </a>
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
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
                    2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                        templates </a> from Bootstrapdash.com</span>
            </div>
        </footer>
    </div>
    <!-- /.modal-dialog -->
    <div class="modal fade" id="modal-lg-detail">
        <div class="modal-dialog modal-lg">
            <div id="loader" style="display: none;">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-light" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Detail Pembayaran
                        <span id="detail-title"></span>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" style="padding: 0 2rem 2rem 2rem;">
                        <table class="table table-bordered table-sm w-100" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>MG</th>
                                    <th>Periode</th>
                                    <th>Tanggal</th>
                                    <th>REG</th>
                                    <th>No SPTA</th>
                                    <th>No TRUK</th>
                                    <th>Pabrik</th>
                                    <th>Harga Beli</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody id="list-detail">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>

                        </table>
                        <div class="row mt-5">
                            <div class="col-md-12 pt-2">
                                <table class="table table-dark w-100">
                                    <tbody>
                                        <tr class="d-flex justify-content-around align-items-center">
                                            <td>Total</td>
                                            <td>:</td>
                                            <td id="totals"></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
@endsection
@section('specific-js')
    <script src="{{ asset('assets/js/function/pembayarnBundle.js') }}"></script>
@endsection
