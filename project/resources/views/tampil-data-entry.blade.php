@php
function formatTanggal($tgl)
{
    $data = explode('-', $tgl);
    $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return "{$data[2]}/{$month[(int) $data[1] - 1]}/{$data[0]}";
}
@endphp
@extends('template.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data Transaksi</h2>
                <div class="right d-flex align-items-center">
                    <div class="input-group">
                        <input type="text" class="form-control text-dark form-control text-dark-sm" id="search" placeholder="Cari Data Petani.." aria-label="Cari Data Petani.." aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-gradient-success" type="button">Cari</button>
                        </div>
                    </div>
                    &nbsp;
                    <button type="button" class="btn btn-gradient-success btn-icon-text d-flex" data-target="#modal-md-filter" id='tbh' data-toggle="modal">
                        <i class="mdi mdi-plus btn-icon-prepend"></i>Filter
                    </button>
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
                                    <th>Periode</th>
                                    <th>Tanggal</th>
                                    <th>REG</th>
                                    <th>No SPTA</th>
                                    <th>No TRUK</th>
                                    <th>Pabrik</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                <?php $no = 1; ?>
                                <?php $sisa = 0; ?>
                                <?php $bobot = 0; ?>
                                @foreach ($data as $item)
                                    <tr class="">
                                        <?php $sisa += $item->sisa; ?>
                                        <?php $bobot += $item->bobot; ?>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->periode }}</td>
                                        <td>{{ formatTanggal(date('Y-m-d', strtotime($item->created_at))) }}</td>
                                        <td>{{ $item->reg }}</td>
                                        <td>{{ $item->nospta }}</td>
                                        <td>{{ $item->nopol }}</td>
                                        <td>{{ $item->pabrik }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info btn-icon-text detail" data-target="#modal-lg-detail" id='tbh' data-toggle="modal" data-id="{{ $item->id_entry }}">
                                                <i class="mdi mdi-information-outline btn-icon-prepend"></i>Detail </button>
                                            <button type="button" class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-lg-tambah" id='tbh' data-toggle="modal" data-id="{{ $item->id_entry }}">
                                                <i class="mdi mdi-lead-pencil btn-icon-prepend"></i>Ubah </button>
                                            <a href="{{ url('/entry') . '/' . $item->id_entry }}" class="btn btn-sm btn-danger btn-icon-text delete">
                                                <i class="mdi mdi-delete-forever btn-icon-prepend"></i>Hapus </a>
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
                                <select class="form-control text-dark" name="pabrik" id="pabrik" required>
                                    <option selected value="">Pilih</option>
                                    @foreach ($pabrik as $item)
                                        <option value="{{ $item->id_pabrik }} | {{ $item->nama_pabrik }}">{{ $item->nama_pabrik }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pabrik">Tanggal</label>
                                <input type="date" class="form-control text-dark" name="tanggal" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="masa">Masa Giling</label>
                                    <input type="text" class="form-control text-dark" placeholder="Masa Giling" name="masa" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group">
                                    <label for="periode">Periode</label>
                                    <select class="form-control text-dark text-dark" name="periode" id="periode" data-change="add" aria-readonly="true" required>
                                        <option selected value="">Pilih</option>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="form-group" id="reg-petani" style="display: none;">
                                    <label for="reg">Reg</label>
                                    <select class="form-control text-dark" name="reg" id="reg" data-change="add" required>
                                        <option selected value="">Pilih</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="petani">Petani</label>
                                    <input type="text" class="form-control text-dark" placeholder="Petani" name="petani" readonly required>
                                </div>
                                <div class="form-group" id="nospta">
                                    <label for="exampleInputPassword1">No SPTA</label>
                                    <input type="text" class="form-control text-dark" placeholder="No SPTA" name="nospta" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="nopol">
                                    <label for="exampleInputPassword1">No POL</label>
                                    <input type="text" class="form-control text-dark" placeholder="Nopol" name="nopol" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group">
                                    <label for="variasi">Variasi</label>
                                    <select class="form-control text-dark" name="variasi" id="variasi" required>
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
                                    <select class="form-control text-dark" name="type" id="type" required>
                                        <option selected value="">Pilih</option>
                                        @foreach ($type as $item)
                                            <option value="{{ $item->id_type }}">{{ $item->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="keterangan">
                                    <label for="exampleInputPassword1">Keterangan</label>
                                    <input type="text" class="form-control text-dark" placeholder="Keterangan" name="keterangan" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="hpp">
                                    <label for="exampleInputPassword1">HPP</label>
                                    <input type="text" class="form-control text-dark" onkeypress="return isNumber(event)" placeholder="Hpp" name="hpp" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="harga_beli">
                                    <label for="exampleInputPassword1">Harga Beli</label>
                                    <input type="text" onkeypress="return isNumber(event)" class="form-control text-dark" placeholder="Harga Beli" name="harga_beli" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group" id="bobot">
                                    <label for="exampleInputPassword1">Bobot</label>
                                    <input type="text" onkeypress="return isNumber(event)" class="form-control text-dark" placeholder="Bobot" name="bobot" required>
                                    <span class="text-dark"></span>
                                </div>
                                <div class="form-group">
                                    <label for="sisa">Sisa</label>
                                    <input type="text" class="form-control text-dark" placeholder="Sisa" name="sisa" readonly required>
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
                    <button type="submit" class="btn btn-gradient-danger" data-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                                <label for="tgl1">Tanggal Awal</label>
                                <input type="date" class="form-control text-dark" name="tanggalawal" id="tgl1">
                                <span class="text-dark"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tgl2">Tanggal Akhir</label>
                                <input type="date" class="form-control text-dark" name="tanggalakhir" id="tgl2">
                                <span class="text-dark"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ url('/entry') }}" class="btn btn-gradient-success filter">Cari</a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
@endsection
@section('specific-js')
    <script src="{{ asset('assets/js/function/Entry.js') }}"></script>
@endsection
