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
                <h2>Data Laporan</h2>
                <div class="right d-flex align-items-center">
                    <button type="button" class="btn btn-success btn-icon-text d-flex" data-target="#modal-md-filter"
                        id='tbh' data-toggle="modal">
                        <i class="mdi mdi-filter-outline"></i>Filter
                    </button>
                    &nbsp;
                    <a class="btn btn-success btn-icon-text d-flex"
                        href="{{ url('/laporan/cetak/') . '/' }}{{ !isset($filter) ? 'month' : $filter['type'] . '=' . $filter['data'] }}">
                        <i class="mdi mdi-printer"></i>Cetak
                    </a>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-hover w-100" style="table-layout: fixed">
                            <thead>
                                <tr class=" w-auto text-center">
                                    <th class="small py-2 px-0">NO</th>
                                    <th class="small py-2 px-0">MG</th>
                                    <th class="medium py-2 px-0">PERIODE</th>
                                    <th class="medium py-2 px-0">TGL</th>
                                    <th class="medium py-2 px-0">PABRIK</th>
                                    <th class="medium py-2 px-0">REG</th>
                                    <th class="medium py-2 px-0">PETANI</th>
                                    <th class="medium py-2 px-0">NO SPTA</th>
                                    <th class="medium py-2 px-0">NO TRUK</th>
                                    <th class="small py-2 px-0">BBT</th>
                                    <th class="small py-2 px-0">VAR</th>
                                    <th class="small py-2 px-0">TYPE</th>
                                    <th class="medium py-2 px-0">PENGIRIM</th>
                                    <th class="medium py-2 px-0">BELI</th>
                                    <th class="medium py-2 px-0">HPP</th>
                                    <th class="medium py-2 px-0">SISA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php $sisa = 0; ?>
                                <?php $bobot = 0; ?>
                                @foreach ($data as $item)
                                    <?php $sisa += $item->sisa; ?>
                                    <?php $bobot += $item->bobot; ?>
                                    <tr style="height: 52px;">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->masa_giling }}</td>
                                        <td>{{ $item->periode }}</td>
                                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->pabrik }}</td>
                                        <td>{{ $item->reg }}</td>
                                        <td>{{ $item->petani }}</td>
                                        <td>{{ $item->nospta }}</td>
                                        <td>{{ $item->nopol }}</td>
                                        <td>{{ $item->bobot }}</td>
                                        <td>{{ $item->variasi_ }}</td>
                                        <td>{{ $item->type_ }}</td>
                                        <td>{{ $item->keterangan === null ? '-' : $item->keterangan }}</td>
                                        <td>{{ $item->harga_beli === null ? '-' : 'Rp. ' . number_format($item->harga_beli, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $item->hpp === null ? '-' : 'Rp. ' . number_format($item->hpp, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            {{ $item->hpp !== null && $item->harga_beli !== null ? 'Rp. ' . number_format(($item->hpp - $item->harga_beli) * $item->bobot, 0, ',', '.') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-5">
                            <div class="col-md-12 pt-2">
                                <table class="table table-dark w-100">
                                    <tbody>
                                        <tr class="bg-dark">
                                            <td></td>
                                            <td>Total Bobot</td>
                                            <td>:</td>
                                            <td>{{ $bobot }} KW</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Total Sisa</td>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($sisa, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class=" footer">
            <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
                    2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                        href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                        templates </a> from Bootstrapdash.com</span>
            </div>
        </footer>
    </div>
    <!-- modal untuk tambah data -->
    <div class="modal fade" id="modal-md-filter">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ url('/laporan') }}" method="post">
                    @csrf
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
                                    <input type="date" value="{{ date('Y-m') }}-01" class="form-control text-dark"
                                        name="tanggalaw" id="taw">
                                    <span class="text-dark"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tanggal Akhir</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control text-dark"
                                        name="tanggalak" id="tak">
                                    <span class="text-dark"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pabrik">Pabrik</label>
                            <select class="form-control text-dark" name="pabrik" id="pabrik">
                                <option selected value="">Pilih</option>
                                @foreach ($pabrik as $item)
                                    <option value="{{ $item->id_pabrik }}">{{ $item->nama_pabrik }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="masa">Masa Giling</label>
                            <input type="text" name="masa" value="{{ date('Y') }}" id="masa"
                                class="form-control texk-dark">
                        </div>
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <select class="form-control text-dark" name="periode" id="periode" data-change="add">
                                <option selected value="">Pilih</option>
                                <option>1</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Type Tebu</label>
                            <select class="form-control text-dark" name="type" id="type">
                                <option selected value="">Pilih</option>
                                @foreach ($type as $item)
                                    <option value="{{ $item->type }}">{{ $item->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" id="filter" class="btn btn-success">Cari</button>
                    </div>
                </form>
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
