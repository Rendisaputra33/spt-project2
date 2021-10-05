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
                <div class="col-lg-12 p-0 d-flex justify-content-between">
                    <h2>Cek HPP</h2>
                    <div class="right d-flex align-items-center">
                        <div class="input-group">
                            <input type="text" id="search" class="form-control form-control-sm" placeholder="Cari Data Petani.." aria-label="Cari Data Petani.." aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-success" type="button">Cari</button>
                            </div>
                        </div>
                        &nbsp;
                        <button type="button" class="btn btn-success btn-icon-text d-flex" data-target="#modal-md-tambah" id='tbh' data-toggle="modal">
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
                                    @foreach ($data as $item)
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
                                                <button type="button" class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-md-edit-hpp" id='tbh' data-toggle="modal" data-id="{{ $item->id_entry }}">
                                                    <i class="mdi mdi-lead-pencil btn-icon-prepend"></i>Ubah </button>
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

        <!-- /.modal-dialog -->
        <form action="" method="post" id="form-">
            @csrf
            <div class="modal fade" id="modal-md-edit-hpp">
                <div class="modal-dialog modal-md">
                    <input type="hidden" name="id" value="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Ubah HPP</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ubah_hpp">HPP</label>
                                <input type="text" placeholder="Hpp" class="form-control text-dark" name="hpp" id="ubah_hpp">
                                <span class="text-dark"></span>
                            </div>
                            <div class="form-group">
                                <label for="pengirim">Keterangan</label>
                                <select class="form-control text-dark" name="pengirim" id="pengirim">
                                    <option selected value="">Pilih</option>
                                    @foreach ($pengirim as $item)
                                        <option value="{{ $item->id_pengirim }}">{{ $item->nama_pengirim }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </form>
    @endsection
    @section('specific-js')
        <script type="module" src="{{ asset('assets/js/function/module/endpoint/hpp/index.js') }}"></script>
    @endsection
