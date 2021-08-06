@php
function formatTanggal($tgl)
{
    $data = explode('-', $tgl);
    $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return "{$data[2]}/{$month[(int) $data[1] - 1]}/{$data[0]}";
}
@endphp
<style>
    td,
    th {
        font-size: 0.75rem !important;
    }

    td.small,
    th.small {
        width: 2rem;
    }

    td.medium,
    th.medium {
        width: 3.8rem;
    }

</style>
@extends('template.cetaklayout')
@section('content')
    <div class="main-panel mx-auto">
        <div class="content-wrapper bg-white px-0" id="print">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Laporan Harian SPT</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless d-flex flex-row justify-content-start">
                        <thead>
                            <tr class="col-sm d-flex flex-column pl-0">
                                <th class="p-2">Transaksi Tanggal</th>
                                <th class="p-2">Pabrik</th>
                                <th class="p-2">Periode</th>
                                <th class="p-2">Tipe Tebu</th>
                            </tr>
                        </thead>
                        <tr class="col-sm d-flex flex-column p-0">
                            <td class="p-2">:</td>
                            <td class="p-2">:</td>
                            <td class="p-2">:</td>
                            <td class="p-2">:</td>
                        </tr>
                        <tbody>
                            <tr class="col-sm d-flex flex-column p-0">
                                <td class="p-2">{{ !isset($tanggal) ? 'Semua Tanggal' : formatTanggal($tanggal[0]) . ' - ' . formatTanggal($tanggal[1]) }}</td>
                                <td class="p-2">{{ !isset($pabrik) ? 'Semua Pabrik' : $pabrik }}</td>
                                <td class="p-2">{{ !isset($periode) ? 'Semua Periode' : $periode }}</td>
                                <td class="p-2">{{ !isset($type) ? 'Semua Type Tebu' : $type }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <table class="table table-borderless d-flex flex-row justify-content-end">
                        <thead>
                            <tr class="col-sm d-flex flex-column">
                                <th class="p-2">Tanggal Cetak</th>
                            </tr>
                        </thead>
                        <tr class="col-sm d-flex flex-column p-0">
                            <td class="p-2">:</td>
                        </tr>
                        <tbody>
                            <tr class="col-sm d-flex flex-column p-0">
                                <td class="p-2">{{ formatTanggal(date('Y-m-d')) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 pt-3">
                    <table class="table table-sm table-borderless border border-5 border-dark w-100" style="table-layout: fixed;">
                        <thead>
                            <tr class="text-bold text-center border border-bottom-2 border-dark w-auto">
                                <th class="small py-2 px-0">NO</th>
                                <th class="small py-2 px-0">MG</th>
                                <th class="medium py-2 px-0">PERIODE</th>
                                <th class="py-2 px-0">TGL</th>
                                <th class="medium py-2 px-0">PABRIK</th>
                                <th class="medium py-2 px-0">REG</th>
                                <th class="py-2 px-0">PETANI</th>
                                <th class="medium py-2 px-0">NO SPTA</th>
                                <th class="medium py-2 px-0">NO TRUK</th>
                                <th class="medium py-2 px-0">BOBOT</th>
                                <th class="small py-2 px-0">VAR</th>
                                <th class="small py-2 px-0">TYPE</th>
                                <th class="small py-2 px-0">KET</th>
                                <th class="py-2 px-0">BELI</th>
                                <th class="py-2 px-0">HPP</th>
                                <th class="py-2 px-0">SISA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $sisa = 0; ?>
                            <?php $bobot = 0; ?>
                            @foreach ($data as $item)
                                <?php $sisa += $item->sisa; ?>
                                <?php $bobot += $item->bobot; ?>
                                <tr class="text-capitalize text-center w-auto">
                                    <td class="small px-0">{{ $no++ }}</td>
                                    <td class="small px-0">{{ $item->masa_giling }}</td>
                                    <td class="medium px-0">{{ $item->periode }}</td>
                                    <td class="px-0">{{ date('d/M/Y', strtotime($item->created_at)) }}</td>
                                    <td class="medium px-0">{{ $item->pabrik }}</td>
                                    <td class="medium px-0">{{ $item->reg }}</td>
                                    <td class="px-0">{{ $item->petani }}</td>
                                    <td class="medium px-0">{{ $item->nospta }}</td>
                                    <td class="medium px-0">{{ $item->nopol }}</td>
                                    <td class="medium px-0">{{ $item->bobot }}</td>
                                    <td class="small px-0">{{ $item->variasi_ }}</td>
                                    <td class="small px-0">{{ $item->type_ }}</td>
                                    <td class="small px-0">{{ $item->keterangan }}</td>
                                    <td class="px-0">Rp. {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                    <td class="px-0">Rp. {{ number_format($item->hpp, 0, ',', '.') }}</td>
                                    <td class="px-0">Rp. 3.000.000,00</td>
                                </tr>
                            @endforeach
                            <tr class="border border-top-2 border-dark">
                                <td class="py-2" colspan="11" class=""></td>
                                <td class="py-2" colspan="2" class="">
                                    Total Bobot : {{ $bobot }} Kwintal
                                </td>
                                <td class="py-2" colspan="1" class=""></td>
                                <td class="py-2" colspan="2" class="">Total Sisa : Rp. {{ number_format($sisa, 0, ',', '.') }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="float-right ml-auto">
            <button onclick="printContent('print')" type="button" class="btn btn-gradient-info btn-icon-text d-flex">
                <i class="mdi mdi-printer"></i>&nbsp;Cetak
            </button>
        </div>
    @endsection
    @section('specific-js')
        <script src="{{ asset('assets/js/function/Entry.js') }}"></script>
    @endsection
