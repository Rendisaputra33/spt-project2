@php
function formatTanggal($tgl)
{
    $data = explode('-', $tgl);
    $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return "{$data[2]}/{$month[(int) $data[1] - 1]}/{$data[0]}";
}
@endphp

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

    #loader {
        width: 100%;
        height: 100%;
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgb(88, 88, 88);
        opacity: 0.7;
        z-index: 9999;
    }

</style>
@section('content')
    <input type="hidden" name="data-filter" data-tanggal="{{ !isset($tanggal) ? 'null' : $tanggal }}">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data Harga Beli</h2>
                <div class="right d-flex align-items-center">
                    <a href="{{ url('/pembayaran/transaksi/cek-harga') }}" class="btn btn-success btn-icon-text d-flex">
                        <i class="mdi mdi-library-books btn-icon-prepend"></i>Kembali
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
                        <table class="table table-hover w-100 mt-5" style="table-layout: fixed">
                            <thead>
                                <tr>
                                    <th class="small">No</th>
                                    <th class="small">MG</th>
                                    <th class="medium">Periode</th>
                                    <th class="large">Tanggal</th>
                                    <th class="medium">REG</th>
                                    <th class="medium">No SPTA</th>
                                    <th class="medium">No TRUK</th>
                                    <th class="medium">Pabrik</th>
                                    <th class="medium">Berat</th>
                                    <th class="large">Pengirim</th>
                                    <th class="large">Harga Beli</th>
                                    <th class="v-large"></th>
                                </tr>
                            </thead>
                            <tbody id="list-data">
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
                                        <td>{{ $item->bobot . ' KW' }}</td>
                                        <td>{{ $item->nama_pengirim }}</td>
                                        <td>
                                            <div style="max-width: 80%;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    {!! $item->harga_beli === null ? '' : '<span>Rp.</span>' !!}
                                                    <span>{{ $item->harga_beli === null ? 'kosong' : number_format($item->harga_beli, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-{{ $item->harga_beli === null ? 'danger' : 'warning' }} btn-icon-text update" data-bobot="{{ $item->bobot }}" data-target="#modal-md-edit" id='tbh' data-toggle="modal" data-harga="{{ $item->harga_beli ? $item->harga_beli : '' }}" data-id="{{ $item->id_entry }}">
                                                <i class="mdi mdi-lead-pencil btn-icon-prepend"></i>{{ $item->harga_beli === null ? 'Lengkapi' : 'Ubah' }}
                                            </button>
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
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ?? bootstrapdash.com
                    2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                        templates </a> from Bootstrapdash.com</span>
            </div>
        </footer>
    </div>
    <form action="" method="post" id="form-" data-form="update">
        @csrf
        <div id="method">
            @method('PUT')
        </div>
        <div class="modal fade" id="modal-md-edit">
            <div class="modal-dialog modal-md">
                <div id="loader" style="display: none;">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-light" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Harga Beli</h3>
                        <button type="button" class="close" data-dismiss="modal" id="close-modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="bobot">
                        <div class="form-group" id="reg">
                            <label for="exampleInputPassword1">Harga Beli</label>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Harga Beli" name="harga" required>
                            <span class="text-dark"></span>
                        </div>
                        <div class="w-100 d-flex justify-content-between flex-row py-2 px-4">
                            <p class="font-weight-bold">Total : </p>
                            <p id="total-update" class="font-weight-bold">4000</p>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>

@endsection
@section('specific-js')
    <script src="{{ asset('assets/js/function/pembayarnBundle.js') }}"></script>
@endsection
