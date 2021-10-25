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

                            &nbsp;
                            <button type="submit" class="btn btn-success btn-icon-text d-flex">
                                <i class="mdi mdi-library-books btn-icon-prepend"></i>Bayar
                            </button>
                            &nbsp;
                            {{-- <button type="button" class="btn btn-success btn-icon-text d-flex add" data-target="#modal-lg-tambah"
                            id='tbh' data-toggle="modal">
                            <i class="mdi mdi-plus btn-icon-prepend"></i>Tambah
                        </button> --}}
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
                                <label for="filter" class="text-bold">Nama Pengirim</label>
                                <div class="col-sm-3 right d-flex align-items-center p-0">
                                    <div class="input-group">
                                        <select class="form-control text-dark" name="filter" id="exampleFormControlSelect2" style="width: 8rem !important;">
                                            @foreach ($pengirim as $item)
                                                <option value="{{ $item->id_pengirim }}">{{ $item->nama_pengirim }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-success filter" type="button">Filter</button>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover w-100 mt-5" style="table-layout: fixed">
                                    <thead>
                                        <tr>
                                            <th class="small">#</th>
                                            <th class="small">MG</th>
                                            <th class="medium">Periode</th>
                                            <th class="medium">Tanggal</th>
                                            <th class="medium">REG</th>
                                            <th class="medium">No SPTA</th>
                                            <th class="medium">No TRUK</th>
                                            <th class="medium">Pabrik</th>
                                            <th class="medium">Berat</th>
                                            <th class="medium">Pengirim</th>
                                            <th class="large">Harga Beli</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-data">
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="id[]" class="form-check-info" value="{{ $item->id_entry }}">
                                                </td>
                                                <td>{{ $item->masa_giling }}</td>
                                                <td>{{ $item->periode }}</td>
                                                <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                                <td>{{ $item->reg }}</td>
                                                <td>{{ $item->nospta }}</td>
                                                <td>{{ $item->nopol }}</td>
                                                <td>{{ $item->pabrik }}</td>
                                                <td>{{ $item->bobot . ' KW' }}</td>
                                                <td>{{ $item->nama_pengirim }}</td>
                                                <td>{{ 'Rp. ' . number_format($item->harga_beli, 0, ',', '.') }}</td>
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
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap
                            admin
                            templates </a> from Bootstrapdash.com</span>
                </div>
            </footer>
        </div>

    @endsection
    @section('specific-js')
        <script type="module" src="{{ asset('assets/js/function/module/endpoint/pembayaran/index.js') }}"></script>
    @endsection
