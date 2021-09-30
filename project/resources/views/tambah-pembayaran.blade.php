    @extends('template.template')
    <style>
        td.small,
        th.small {
            width: 2rem;
        }

        td.medium,
        th.medium {
            width: 5rem;
        }

        td.large,
        th.large {
            width: 8rem;
        }

        td.v-large,
        th.v-large {
            width: 15rem;
        }

    </style>
    @section('content')
        <div class="main-panel">

            <div class="content-wrapper">
                <form action="{{ route('bayar') }}" method="post">
                    @csrf
                    <div class="col-lg-12 p-0 d-flex justify-content-between">
                        <h2>Data Pembayaran</h2>
                        <div class="right d-flex align-items-center">
                            <div class="input-group">
                                {{-- <label for="exampleFormControlSelect2">Default select</label> --}}
                                <select class="form-control" name="filter" id="exampleFormControlSelect2"
                                    style="width: 8rem !important;">
                                    @foreach ($pengirim as $item)
                                        <option value="{{ $item->id_pengirim }}">{{ $item->nama_pengirim }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-success filter" type="button">Filter</button>
                                </div>
                            </div>
                            &nbsp;
                            <button type="submit" class="btn btn-success btn-icon-text d-flex">
                                <i class="mdi mdi-library-books btn-icon-prepend"></i>Bayar
                            </button>
                            &nbsp;
                            <a href="{{ url('/pembayaran/transaksi/cek-harga') }}"
                                class="btn btn-success btn-icon-text d-flex">
                                <i class="mdi mdi-clipboard-text btn-icon-prepend"></i>Cek
                            </a>
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
                                <table class="table table-sm table-hover w-100" style="table-layout: fixed">
                                    <thead>
                                        <tr>
                                            <th class="small">#</th>
                                            <th class="small">MG</th>
                                            <th class="medium">Periode</th>
                                            <th class="large">Tanggal</th>
                                            <th class="medium">REG</th>
                                            <th class="medium">No SPTA</th>
                                            <th class="medium">No TRUK</th>
                                            <th class="large">Pabrik</th>
                                            <th class="v-large"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-data">
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="id[]" class="form-check-info"
                                                        value="{{ $item->id_entry }}">
                                                </td>
                                                <td>{{ $item->masa_giling }}</td>
                                                <td>{{ $item->periode }}</td>
                                                <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                                <td>{{ $item->reg }}</td>
                                                <td>{{ $item->nospta }}</td>
                                                <td>{{ $item->nopol }}</td>
                                                <td>{{ $item->pabrik }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info btn-icon-text detaill"
                                                        data-target="#modal-lg-detail" id='tbh' data-toggle="modal"
                                                        data-id="">
                                                        <i class="mdi mdi-information-outline btn-icon-prepend"></i>Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <footer class="footer">
                <div class="container-fluid clearfix">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                        bootstrapdash.com 2020</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                            href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap
                            admin
                            templates </a> from Bootstrapdash.com</span>
                </div>
            </footer>

        </div>


        <!-- modal untuk tambah data -->
        <div class="modal fade" id="modal-lg-detail">
            <div class="modal-dialog modal-lg d-flex justify-content-center">
                <div class="modal-content modal-md-custom">
                    <div class="modal-header">
                        <h3 class="modal-title">Detail</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <table class="table d-flex flex-row justify-content-lg-around">
                            <thead>
                                <tr class="col-sm d-flex flex-column">
                                    <th>Periode</th>
                                    <th>Masa Giling</th>
                                    <th>Tanggal</th>
                                    <th>REG</th>
                                    <th>Petani</th>
                                    <th>No SPTA</th>
                                    <th>No POL</th>
                                    <th>Pabrik</th>

                                </tr>
                            </thead>
                            <tr class="col-sm d-flex flex-column p-0">
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>

                            </tr>
                            <tbody>
                                <tr class="col-sm d-flex flex-column">
                                    <td class="periode">dummy</td>
                                    <td class="masa">dummy</td>
                                    <td class="tanggal">dummy</td>
                                    <td class="reg">dummy</td>
                                    <td class="petani"></td>
                                    <td class="nospta">dummy</td>
                                    <td class="nopol">dummy</td>
                                    <td class="pabrik">dummy</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr class="col-sm d-flex flex-column">
                                    <th>Variasi</th>
                                    <th>Type Tebu</th>
                                    <th>Bobot(KW)</th>
                                    <th>Ket</th>
                                    <th>Harga Beli</th>
                                    <th>HPP</th>
                                    <th>Sisa</th>
                                </tr>
                            </thead>
                            <tr class="col-sm d-flex flex-column p-0">
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                                <td>:</td>
                            </tr>
                            <tbody>
                                <tr class="col-sm d-flex flex-column">
                                    <td class="variasi">dummy</td>
                                    <td class="type">dummy</td>
                                    <td class="bobot">dummy</td>
                                    <td class="ket">dummy</td>
                                    <td class="harga">dummy</td>
                                    <td class="hpp">dummy</td>
                                    <td class="sisa">dummy</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger float-right" data-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

    @endsection
    @section('specific-js')
        <script type="module" src="{{ asset('assets/js/function/module/endpoint/pembayaran/index.js') }}"></script>
    @endsection
