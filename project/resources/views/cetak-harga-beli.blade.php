@php
function formatTanggal($tgl)
{
    $data = explode('-', $tgl);
    $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return "{$data[2]}/{$month[(int) $data[1] - 1]}/{$data[0]}";
}

function getMonth($m)
{
    $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return $month[(int) $m - 1];
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

</style>
<style type="text/css" media="print">
    /* ISO Paper Size */
        @page {
        size: A4 landscape;
        }
</style>
@section('content')
    <div class="main-panel mx-auto">
        <div class="content-wrapper bg-white px-0" id="print">
            <div class="row">
                <div class="col-md-12 text-left">
                    <p class="tglcetak">
                        <?php
                        echo date('d/m/Y');
                        ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>LAPORAN PEMBAYARAN SPT</h3>
                    <div class="text text-uppercase mt-4 text-center pb-4" style="border-bottom: 2px solid #000;">
                        <p class="m-0 " style="letter-spacing: 1px; font-weight: normal;">jl. raya blambangan 88 salakan krebet - malang</p>
                        <p class="m-0 " style="letter-spacing: 1px; font-weight: normal;">telp (0341) 8038008, 085100727217, 08179660466</p>
                    </div>
                    

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    <p class="text-uppercase" style="font-size: 1.2rem;">no invoice. {{ $invoice }}</p>
                </div>
                <div class="col-md-4 text-capitalize ">
                    <span>
                        <p class="mb-2">Malang, {{ date('d') }} {{ getMonth(date('m')) }} {{ date('Y') }}</p>
                        <p class="mb-2">Kepada YTH</p>
                        <p class="mb-2">{{ $data[0]['nama_pengirim'] }}</p>
                        <p class="text-uppercase m-0">krebet malang</p>
                    </span>

                </div>
                <div class="col-md-12 mt-4">
                    <table class="cetak table table-sm table-borderless border border-5 border-dark w-100" style="table-layout: fixed;">
                        <tr class=" text-bold text-center border border-bottom-2 border-dark w-100" id="header">
                            <th>NO</th>
                            <th>MG</th>
                            <th>PERIODE</th>
                            <th>TGL</th>
                            <th>PABRIK</th>
                            <th>NO SPTA</th>
                            <th>NO TRUK</th>
                            <th>BOBOT</th>
                            <th>VAR</th>
                            <th>TYPE</th>
                            <th>BELI</th>
                            <th>TOTAL</th>
                        </tr>
                        <tbody>
                            <?php $sisa = 0; ?>
                            <?php $bobot = 0; ?>
                            @foreach ($data as $item)
                                <?php $sisa += $item->harga_beli * $item->bobot; ?>
                                <?php $bobot += $item->bobot; ?>
                                <tr class="text-capitalize text-center w-auto">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->masa_giling }}</td>
                                    <td>{{ $item->periode }}</td>
                                    <td class="">{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->pabrik }}</td>
                                    <td>{{ $item->nospta }}</td>
                                    <td>{{ $item->nopol }}</td>
                                    <td>{{ $item->bobot }}</td>
                                    <td>{{ $item->variasi_ }}</td>
                                    <td>{{ $item->type_ }}</td>
                                    <td>{{ $item->harga_beli !== null ? 'Rp. ' . number_format($item->harga_beli, 0, ',', '.') : '-' }}
                                    </td>
                                    <td>{{ 'Rp. ' . number_format($item->harga_beli * $item->bobot, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr class="border border-top-2 border-dark">
                                <td class="py-2" colspan="7" class=""></td>
                                <td class=" py-2" colspan="2" class="">
                                    Total Bobot : {{ $bobot }} Kwintal
                                </td>
                                <td class="
                                    py-2" colspan="1" class=""></td>
                                <td class=" py-2" colspan="2" class="">Total : Rp. {{ number_format($sisa, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-8 mt-5"></div>
                <div class="col-md-4 mt-5 ">
                    <p>Hormat Kami</p>
                </div>
            </div>
        </div>
        <div class="float-right ml-auto">
            <button onclick="printContent('print')" type="button" class="btn btn-info btn-icon-text d-flex">
                <i class="mdi mdi-printer"></i>&nbsp;Cetak
            </button>
        </div>
    @endsection
    @section('specific-js')
        <script src="{{ asset('assets/js/function/Entry.js') }}"></script>
    @endsection
