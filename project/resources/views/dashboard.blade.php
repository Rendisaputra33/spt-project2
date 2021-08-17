@extends('template.template')
<style>
    td,
    th {
        font-size: 0.75rem !important;
        text-align: center !important;

    }


    td.small,
    th.small {
        width: 2rem;
    }

    td.medium,
    th.medium {
        width: 4rem;

    }

</style>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper px-2">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Dashboard</h2>

            </div>

            <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-hover w-100" style="table-layout: fixed">
                            <thead>
                                <tr class=" w-auto">
                                    <th class="small py-2 px-0">NO</th>
                                    <th class="small py-2 px-0">MG</th>
                                    <th class="medium py-2 px-0">PERIODE</th>
                                    <th class="py-2 px-0">TGL</th>
                                    <th class="medium py-2 px-0">PABRIK</th>
                                    <th class="medium py-2 px-0">REG</th>
                                    <th class="py-2 px-0">PETANI</th>
                                    <th class="medium py-2 px-0">NO SPTA</th>
                                    <th class="medium py-2 px-0">NO TRUK</th>
                                    <th class="medium py-2 px-0">BOBOT</th>
                                    <th class="small py-2 px-0">VAR</th>
                                    <th class="small py-2 px-0">TYPE</th>
                                    <th class="medium py-2 px-0">KET</th>
                                    <th class="py-2 px-0">BELI</th>
                                    <th class="py-2 px-0">HPP</th>
                                    <th class="py-2 px-0">SISA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data as $item)
                                    <tr style="height: 52px">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->masa_giling }}</td>
                                        <td>{{ $item->periode }}</td>
                                        <td>{{ date('d/M/Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->pabrik }}</td>
                                        <td>{{ $item->reg }}</td>
                                        <td>{{ $item->petani }}</td>
                                        <td>{{ $item->nospta }}</td>
                                        <td>{{ $item->nopol }}</td>
                                        <td>{{ $item->bobot }}</td>
                                        <td>{{ $item->variasi_ }}</td>
                                        <td>{{ $item->type_ }}</td>
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
                            <div class="form-group" id="tanggal">
                                <label for="exampleInputPassword1">Tanggal Awal</label>
                                <input type="date" class="form-control" name="tanggal" required>
                                <span class="text-dark"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group" id="tanggal">
                                <label for="exampleInputPassword1">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tanggal" required>
                                <span class="text-dark"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="pg">
                        <label for="exampleInputPassword1">PG</label>
                        <input type="text" class="form-control" name="pg" required>
                        <span class="text-dark"></span>
                    </div>
                    <div class="form-group" id="periode">
                        <label for="exampleInputPassword1">Periode</label>
                        <input type="text" class="form-control" name="periode" required>
                        <span class="text-dark"></span>
                    </div>
                    <div class="form-group" id="type_tebu">
                        <label for="exampleInputPassword1">Type Tebu</label>
                        <input type="text" class="form-control" name="type_tebu" required>
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
