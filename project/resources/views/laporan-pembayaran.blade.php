@extends('template.template')
<style>
    td,
    th {
        font-size: 0.75rem !important;
        text-align: center !important;

    }


    td.small,
    th.small {
        width: 1.7rem;
    }

    td.medium,
    th.medium {
        width: 4.8rem;

    }

</style>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper px-2 ">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data Laporan Pembayaran</h2>
                <div class="right d-flex align-items-center">
                    <button type="button" class="btn btn-success btn-icon-text d-flex" data-target="#modal-md-filter" id='tbh' data-toggle="modal">
                        <i class="mdi mdi-filter-outline"></i>Filter
                    </button>
                    &nbsp;
                    {{-- <a class="btn btn-success btn-icon-text d-flex" href="{{ url('/laporan/cetak/') . '/' }}{{ !isset($filter) ? 'month' : $filter['type'] . '=' . $filter['data'] }}">
                        <i class="mdi mdi-printer"></i>Cetak
                    </a> --}}
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
                <div class="card">
                    <div class="card-body">
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
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->invoice }}</td>
                                        <td>{{ date('d/m/Y', strtotime($item->creates)) }}</td>
                                        <td>{{ $item->pengirim }}</td>
                                        <td class="d-flex justify-content-between align-items-center">
                                            <span>Rp.</span>  
                                            <span>{{ number_format($item->totals, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            <a target="_blank" href="{{ url('/pembayaran/transaksi/report') . '?invoice=' . $item->invoice }}" class="btn btn-sm btn-info btn-icon-text delete">
                                                Cetak
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
        <footer class=" footer">
            <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
                    2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                        templates </a> from Bootstrapdash.com</span>
            </div>
        </footer>
    </div>
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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tgl1">Tanggal Awal</label>
                                <input type="date" value="{{ date('Y-m') }}-01" class="form-control text-dark" name="tanggalawal" id="tgl1">
                                <span class="text-dark"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tgl2">Tanggal Akhir</label>
                                <input type="date" value="{{ date('Y-m-d') }}" class="form-control text-dark" name="tanggalakhir" id="tgl2">
                                <span class="text-dark"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="" class="btn btn-success filter-pem">Cari</a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
@endsection
@section('specific-js')
    <script src="{{ asset('assets/js/function/Laporan.js') }}"></script>
@endsection
