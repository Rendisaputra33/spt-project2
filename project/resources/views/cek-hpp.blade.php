    @extends('template.cekHpp')
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
                <div class="col-lg-12 p-0 d-flex justify-content-between">
                    <h2>Cek HPP</h2>
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
                            <table class="table table-sm table-hover w-100" style="table-layout: fixed">
                                <thead>
                                    <tr>
                                        <th class="small">No</th>
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
                                <tbody id="list">
                                    <?php $bobot = 0; ?>
                                    @foreach ($data as $item)
                                        <tr class="___class_+?26___">
                                            <?php $bobot += $item->bobot; ?>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->masa_giling }}</td>
                                            <td>{{ $item->periode }}</td>
                                            <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                            <td>{{ $item->reg }}</td>
                                            <td>{{ $item->nospta }}</td>
                                            <td>{{ $item->nopol }}</td>
                                            <td>{{ $item->pabrik }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info btn-icon-text detail" data-target="#modal-lg-detail" id='tbh' data-toggle="modal" data-id="{{ $item->id_entry }}">
                                                    <i class="mdi mdi-information-outline btn-icon-prepend"></i>Detail </button>
                                                <button type="button" class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-lg-tambah" id='tbh' data-toggle="modal" data-id="{{ $item->id_entry }}">
                                                    <i class="mdi mdi-lead-pencil btn-icon-prepend"></i>Ubah </button>
                                                {{-- <a href="{{ url('/entry') . '/' . $item->id_entry }}" class="btn btn-sm btn-danger btn-icon-text delete">
                                                    <i class="mdi mdi-delete-forever btn-icon-prepend"></i>Hapus </a> --}}
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
    @endsection
    @section('specific-js')
        {{-- <script src="{{ asset('assets/js/function/Petani.js') }}"></script> --}}
    @endsection
