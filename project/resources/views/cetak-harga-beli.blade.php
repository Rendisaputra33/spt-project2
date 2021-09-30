@php
function formatTanggal($tgl)
{
    $data = explode('-', $tgl);
    $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return "{$data[2]}/{$month[(int) $data[1] - 1]}/{$data[0]}";
}
@endphp

@extends('template.cetaklayout')
<style>
    td,
    th {
        font-size: 0.75rem !important;

    }

    th {
        font-weight: bold !important;
    }

    td.small,
    th.small {
        width: 2.1rem;
    }

    td.medium,
    th.medium {
        width: 4.2rem;

    }


    p.tglcetak {
        display: none;
        font-size: 0.75rem !important;

    }

    /*.page-break {*/
    /*    page-break-before: auto !important;*/
    /*}*/
    /*tr.firstrow {*/
    /* page-break-inside: avoid !important;*/
    /*}*/

</style>
@section('content')
    <div class="main-panel mx-auto">
        <div class="content-wrapper bg-white px-0" id="print">
            <div class="row">
                <div class="col-md-12 text-left">
                    <p class="tglcetak">
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Laporan Harian SPT</h3>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <table class="table table-borderless d-flex flex-row justify-content-start">
                        <thead>
                            <tr class="col-sm d-flex flex-column pl-0">
                                <th class="p-2">Transaksi Tanggal</th>
                                <th class="p-2">Pabrik</th>

                            </tr>
                        </thead>
                        <tr class="col-sm d-flex flex-column p-0">
                            <td class="p-2">:</td>
                            <td class="p-2">:</td>

                        </tr>
                        <tbody>
                            <tr class="col-sm d-flex flex-column p-0">
                                <td class="p-2"></td>
                                <td class="p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless d-flex flex-row justify-content-end">
                        <thead>
                            <tr class="col-sm d-flex flex-column">
                                <th class="p-2">Periode</th>
                                <th class="p-2">Tipe Tebu</th>
                            </tr>
                        </thead>
                        <tr class="col-sm d-flex flex-column p-0">
                            <td class="p-2">:</td>
                            <td class="p-2">:</td>
                        </tr>
                        <tbody>
                            <tr class="col-sm d-flex flex-column p-0">

                                <td class="p-2"></td>
                                <td class="p-2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 mt-4">
                    <table class="cetak table table-sm table-borderless border border-5 border-dark w-100" style="table-layout: fixed;">
                        <tr class=" text-bold text-center border border-bottom-2 border-dark w-100" id="header">
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
                            <th class="medium py-2 px-0">KET</th>
                            <th class="py-2 px-0">BELI</th>
                            <th class="py-2 px-0">HPP</th>
                            <th class="py-2 px-0">SISA</th>
                        </tr>
                        <tbody>
                            <tr class="text-capitalize text-center w-auto">
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                                <td>dummy</td>
                            </tr>

                            <tr class="border border-top-2 border-dark">
                                <td class="py-2" colspan="11" class=""></td>
                                <td class=" py-2" colspan="2" class="">
                                    Total Bobot :  Kwintal
                                </td>
                                <td class=" py-2" colspan="1" class=""></td>
                                <td class=" py-2" colspan="2"
                                    class="">Total Sisa : Rp. </td>

                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class=" float-right ml-auto">
                                    <button onclick="printContent('print')" type="button" class="btn btn-info btn-icon-text d-flex">
                                        <i class="mdi mdi-printer"></i>&nbsp;Cetak
                                    </button>
                </div>
            @endsection
            @section('specific-js')
                <script src="{{ asset('assets/js/function/Entry.js') }}"></script>
            @endsection
