@extends('template.template')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 p-0 d-flex justify-content-between">
                <h2>Data User</h2>
                <div class="right d-flex align-items-center">
                    <div class="input-group">
                        <input type="text" id="search" class="form-control form-control-sm" placeholder="Cari Data User.." aria-label="Cari Data Petani.." aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-gradient-success" type="button">Cari</button>
                        </div>
                    </div>
                    &nbsp;
                    <button type="button" class="btn btn-gradient-success btn-icon" data-target="#modal-md-tambah" id='tbh' data-toggle="modal">
                        <i class="mdi mdi-plus"></i>
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
                <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>level</th>
                                        <th>Tanggal Masuk</th>
                                    </tr>
                                </thead>
                                <tbody id="list">
                                    <?php $no = 1; ?>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->level === 1 ? 'Admin' : 'Super Admin' }}</td>
                                            <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning btn-icon-text update" data-target="#modal-md-tambah" id='tbh' data-toggle="modal" data-id="{{ $item->id_user }}">
                                                    <i class="mdi mdi-lead-pencil btn-icon-prepend"></i> Ubah </button>
                                                <a class="btn btn-sm btn-danger btn-icon-text delete" href="{{ url('/user') }}/{{ $item->id_user }}"> <i class="mdi mdi-delete btn-icon-prepend"></i> Hapus </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal untuk tambah data -->
        <form action="{{ url('/auth/register') }}" method="post" id="form-">
            @csrf
            <div id="method"></div>
            <div class="modal fade" id="modal-md-tambah">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Tambah Data User</h3>
                            <button type="button" class="close" data-dismiss="modal" id="close-modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama</label>
                                <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                                <span class="text-dark"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Username</label>
                                <input type="text" class="form-control" placeholder="Username" name="username" required>
                                <span class="text-dark"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                <span class="text-dark"></span>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" name="level" id="level">
                                    <option selected value="">Pilih</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Super Admin</option>
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
            <!-- /.modal-dialog -->
    </div>
    </form>
@endsection
@section('specific-js')
    <script src="{{ asset('assets/js/function/User.js') }}"></script>
@endsection
