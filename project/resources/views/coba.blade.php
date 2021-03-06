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
                    <div class="text text-uppercase mt-4 text-center">
                        <p class="m-0 " style="letter-spacing: 1px; font-weight: normal;">jl. raya blambangan 88 salakan krebet - malang</p>
                        <p class="m-0 " style="letter-spacing: 1px; font-weight: normal;">telp (0341) 8038008, 085100727217, 08179660466</p>
                    </div>
                    <hr class="my-4" style="height: 2px; background-color: #212121;">

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    <p class="text-uppercase" style="font-size: 1.2rem;">no invoice. 001/rg/ix/2021</p>
                </div>
                <div class="col-md-4 text-capitalize ">
                    <span>
                        <p class="mb-2">Malang, 10 september 2021</p>
                        <p class="mb-2">Kepada YTH</p>
                        <p class="mb-2">-Nama Pengirim-</p>
                        <p class="text-uppercase m-0">krebet malang</p>
                    </span>

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
                            <th class="medium py-2 px-0">PENGIRIM</th>
                            <th class="py-2 px-0">BELI</th>
                            <th class="py-2 px-0">HPP</th>
                            <th class="py-2 px-0">SISA</th>
                        </tr>
                        <tbody>
                            <?php $sisa = 0; ?>
                            <?php $bobot = 0; ?>
                            @foreach ($data as $item)
                                <?php $item->harga_beli && $item->hpp ? ($sisa += ($item->hpp - $item->harga_beli) * $item->bobot) : ($sisa += 0); ?>
                                <?php $bobot += $item->bobot; ?>
                                <tr class="text-capitalize text-center w-auto">
                                    <td class="small px-0">{{ $loop->iteration }}</td>
                                    <td class="small px-0">{{ $item->masa_giling }}</td>
                                    <td class="medium px-0">{{ $item->periode }}</td>
                                    <td class="px-0">{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                    <td class="medium px-0">{{ $item->pabrik }}</td>
                                    <td class="medium px-0">{{ $item->reg }}</td>
                                    <td class="px-0">{{ $item->petani }}</td>
                                    <td class="medium px-0">{{ $item->nospta }}</td>
                                    <td class="medium px-0">{{ $item->nopol }}</td>
                                    <td class="medium px-0">{{ $item->bobot }}</td>
                                    <td class="small px-0">{{ $item->variasi_ }}</td>
                                    <td class="small px-0">{{ $item->type_ }}</td>
                                    <td class="medium px-0">{{ $item->nama_pengirim ? $item->nama_pengirim : '-' }}</td>
                                    <td class="px-0">{{ $item->harga_beli ? 'Rp. ' . number_format($item->harga_beli, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-0">Rp. {{ number_format($item->hpp, 0, ',', '.') }}</td>
                                    <td class="px-0">{{ $item->harga_beli && $item->hpp ? 'Rp. ' . number_format(($item->hpp - $item->harga_beli) * $item->bobot, 0, ',', '.') : '-' }}</td>
                                </tr>
                            @endforeach

                            <tr class="border border-top-2 border-dark">
                                <td class="py-2" colspan="11" class=""></td>
                                <td class=" py-2" colspan="2" class="">
                                    Total Bobot : {{ $bobot }} Kwintal
                                </td>
                                <td class="
                                    py-2" colspan="1" class=""></td>
                                <td class=" py-2" colspan="2" class="">Total Sisa : Rp. {{ number_format($sisa, 0, ',', '.') }}</td>
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
        <div class="
                                    float-right ml-auto">
            <button onclick="printContent('print')" type="button" class="btn btn-info btn-icon-text d-flex">
                <i class="mdi mdi-printer"></i>&nbsp;Cetak
            </button>
        </div>
    @endsection
    @section('specific-js')
        <script src="{{ asset('assets/js/function/Entry.js') }}"></script>
    @endsection
