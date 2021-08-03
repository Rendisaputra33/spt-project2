@extends('template.cetaklayout')
@section('content')
    <div class="main-panel mx-auto">
        <div class="content-wrapper bg-white px-0">
            <div class="col-lg-12 grid-margin stretch-card p-0 mt-3">
                <table class="table">
                    <thead>
                        <tr class="text-bold text-uppercase text-center">
                            <th>No</th>
                            <th>Periode</th>
                            <th>Tanggal</th>
                            <th>REG</th>
                            <th>No SPTA</th>
                            <th>NO TRUK</th>
                            <th>BOBOT</th>
                            <th>RF</th>
                            <th>TEBANGAN</th>
                            <th>KET</th>
                            <th>BELI</th>
                            <th>HPP</th>
                            <th>SISA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($data as $item)
                            <tr class="text-uppercase text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->masa_giling }}</td>
                                <td>{{ date('d/M/Y', strtotime($item->created_at)) }}</td>
                                <td>{{ $item->pabrik }}</td>
                                <td>{{ $item->reg }}</td>
                                <td>{{ $item->nopol }}</td>
                                <td>{{ $item->bobot }}</td>
                                <td>{{ $item->variasi_ }}</td>
                                <td>{{ $item->type_ }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->harga_beli }}</td>
                                <td>{{ $item->hpp }}</td>
                                <td>{{ $item->sisa }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="float-right">
                <button id="print" type="button" class="btn btn-gradient-info btn-icon-text d-flex">
                    <i class="mdi mdi-printer"></i>&nbsp;Cetak
                </button>
            </div>
        </div>
    </div>

@endsection
@section('specific-js')
    <script src="{{ asset('assets/js/function/Entry.js') }}"></script>
@endsection
