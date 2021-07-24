@extends('template.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data Transaksi</h2>
                <div class="right d-flex align-items-center">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="search" placeholder="Cari Data Petani.." aria-label="Cari Data Petani.." aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-gradient-success" type="button">Cari</button>
                        </div>
                    </div>
                    &nbsp;
                    <button type="button" class="btn btn-gradient-success btn-icon-text d-flex add" data-target="#modal-lg-tambah" id='tbh' data-toggle="modal">
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
                                    <th>Masa Giling</th>
                                    <th>Periode</th>
                                    <th>Tanggal</th>
                                    <th>REG</th>
                                    <th>No SPTA</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                <?php $no = 1; ?>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->masa_giling }}</td>
                                        <td>{{ $item->periode }}</td>
                                        <td>{{ date('d/M/Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->reg }}</td>
                                        <td>{{ $item->nospta }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info btn-icon-text">
                                                <i class="mdi mdi-information-outline btn-icon-prepend"></i> Detail </button>
                                            <button type="button" class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-lg-tambah" id='tbh' data-toggle="modal" data-id="{{ $item->id_entry }}">
                                                <i class="mdi mdi-lead-pencil btn-icon-prepend"></i> Ubah </button>
                                            <a href="{{ url('/entry') . '/' . $item->id_entry }}" class="btn btn-sm btn-danger btn-icon-text delete">
                                                <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Hapus </a>
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
    <!-- modal untuk tambah data -->
    <form action="{{ url('/entry') }}" method="post" id="form-">
        @csrf
        <div id="method"></div>
        <div class="modal fade" id="modal-lg-tambah">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Data Entry</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="col-md-12" style="padding-left: 40px; padding-right: 40px;">
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
                                <label for="pabrik">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="masa">Masa Giling</label>
                                    <input type="text" class="form-control" placeholder="Masa Giling" name="masa" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group">
                                    <label for="periode">Periode</label>
                                    <select class="form-control" name="periode" id="periode" data-change="add" required>
                                        <option selected value="">Pilih</option>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reg">Reg</label>
                                    <select class="form-control" name="reg" id="reg" data-change="add" required>
                                        <option selected value="">Pilih</option>
                                        @foreach ($petani as $item)
                                            <option value="{{ $item->reg }}">{{ $item->nama_petani }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="nospta">
                                    <label for="exampleInputPassword1">No SPTA</label>
                                    <input type="text" class="form-control" placeholder="No SPTA" name="nospta" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="nopol">
                                    <label for="exampleInputPassword1">No POL</label>
                                    <input type="text" class="form-control" placeholder="Nopol" name="nopol" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group">
                                    <label for="variasi">Variasi</label>
                                    <select class="form-control" name="variasi" id="variasi" required>
                                        <option selected value="">Pilih</option>
                                        @foreach ($variasi as $item)
                                            <option value="{{ $item->id_variasi }}">{{ $item->variasi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" name="type" id="type" required>
                                        <option selected value="">Pilih</option>
                                        @foreach ($type as $item)
                                            <option value="{{ $item->id_type }}">{{ $item->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="keterangan">
                                    <label for="exampleInputPassword1">Keterangan</label>
                                    <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="hpp">
                                    <label for="exampleInputPassword1">HPP</label>
                                    <input type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Hpp" name="hpp" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="harga_beli">
                                    <label for="exampleInputPassword1">Harga Beli</label>
                                    <input type="text" onkeypress="return isNumber(event)" class="form-control" placeholder="Harga Beli" name="harga_beli" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="bobot">
                                    <label for="exampleInputPassword1">Bobot</label>
                                    <input type="text" onkeypress="return isNumber(event)" class="form-control" placeholder="Bobot" name="bobot" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group">
                                    <label for="sisa">Sisa</label>
                                    <input type="text" class="form-control" placeholder="Sisa" name="sisa" readonly required>
                                    <span class="text-dark"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-gradient-success">Simpan</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
    </form>
    <!-- modal untuk tambah data -->
    <div class="modal fade" id="modal-lg-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Detail</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endsection
@section('specific-js')
    <script src="{{ asset('assets/js/function/Entry.js') }}"></script>
@endsection
