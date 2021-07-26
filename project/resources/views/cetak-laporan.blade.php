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
                                <td>{{ $item->reg }}</td>
                                <td>{{ $item->nospta }}</td>
                                <td>{{ $item->nopol }}</td>
                                <td>{{ $item->bobot }}</td>
                                <td>{{ $item->variasi }}</td>
                                <td>{{ $item->type }}</td>
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
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/printThis.js') }}"></script>
    <script>
        $("#print").click(function() {
            $(".table").printThis({
                debug: false, // show the iframe for debugging
                importCSS: true, // import parent page css
                importStyle: false, // import style tags
                printContainer: true, // print outer container/$.selector
                loadCSS: "file:///E:/apps/xampp/htdocs/spt-project2.1/assets/css/cetak-laporan.css", // path to additional css file - use an array [] for multiple
                pageTitle: "", // add title to print page
                removeInline: false, // remove inline styles from print elements
                removeInlineSelector: "*", // custom selectors to filter inline styles. removeInline must be true
                printDelay: 333, // variable print delay
                header: null, // prefix to html
                footer: null, // postfix to html
                base: false, // preserve the BASE tag or accept a string for the URL
                formValues: true, // preserve input/form values
                canvas: false, // copy canvas content
                doctypeString: '...', // enter a different doctype for older markup
                removeScripts: false, // remove script tags from print content
                copyTagClasses: false, // copy classes from the html & body tag
                beforePrintEvent: null, // function for printEvent in iframe
                beforePrint: null, // function called before iframe is filled
                afterPrint: null // function called before iframe is removed
            });
        })
    </script>
@endsection
