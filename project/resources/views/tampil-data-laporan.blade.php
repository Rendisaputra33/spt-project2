@extends('template.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data Laporan</h2>
                <div class="right d-flex align-items-center">

                    <button type="button" class="btn btn-gradient-success btn-icon-text d-flex" data-target="#modal-md-filter" id='tbh' data-toggle="modal">
                        <i class="mdi mdi-filter-outline"></i>Filter
                    </button>
                    &nbsp;
                    <a class="btn btn-gradient-success btn-icon-text d-flex" href="{{ url('/') . '/laporan/cetak/' }}{{ isset($_GET['f']) ? $_GET['f'] : '' }}">
                        <i class="mdi mdi-printer"></i>Cetak
                    </a>
                </div>

            </div>
            <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" style="text-align:center;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>MASA GILING</th>
                                    <th>TANGGAL</th>
                                    <th>REG</th>
                                    <th>PETANI</th>
                                    <th>NO SPTA</th>
                                    <th>NO TRUK</th>
                                    <th>BOBOT</th>
                                    <th>RF</th>
                                    <th>TEBANGAN</th>
                                    <th>KET</th>
                                    <th>BELI</th>
                                    <th>HPP</th>
                                    <th>SISA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->masa_giling }}</td>
                                        <td>{{ date('d/M/Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->reg }}</td>
                                        <td>{{ $item->reg }}</td>
                                        <td>{{ $item->nospta }}</td>
                                        <td>{{ $item->nopol }}</td>
                                        <td>{{ $item->bobot }}</td>
                                        <td>{{ $item->variasi }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>Rp. {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($item->hpp, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($item->sisa, 0, ',', '.') }}</td>
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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Awal</label>
                                <input type="date" class="form-control" name="tanggal" id="taw">
                                <span class="text-dark"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tanggal" id="tak">
                                <span class="text-dark"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pabrik">Pabrik</label>
                        <select class="form-control" name="pabrik" id="pabrik" required>
                            <option selected value="">Pilih</option>
                            @foreach ($pabrik as $item)
                                <option value="{{ $item->id_pabrik }}">{{ $item->nama_pabrik }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="periode">Periode</label>
                        <select class="form-control" name="periode" id="periode" data-change="add" required>
                            <option selected value="">Pilih</option>
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Type Tebu</label>
                        <select class="form-control" name="type" id="type" required>
                            <option selected value="">Pilih</option>
                            @foreach ($type as $item)
                                <option value="{{ $item->id_type }}">{{ $item->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="" id="filter" class="btn btn-gradient-success">Cari</a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endsection
@section('specific-js')
    <script src="{{ asset('assets/js/function/Laporan.js') }}"></script>
@endsection