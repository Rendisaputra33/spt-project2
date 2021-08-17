<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPT | {{ $title === null ? 'Page' : $title }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="baseurl" aria-valuemin="{{ url('/') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alerts-css@1.0.2/assets/css/alerts-css.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icon/css/all.min.css') }}">
    <style type="text/css" media="print">
        @page {
            size: landscape !important;
            margin: 2rem 0 2rem 0;
            margin: 3.20rem 0 2rem 0;
            /* this affects the margin in the printer settings */
        }

        body {
            margin: 0 1rem !important;
        }

        table.cetak>tbody>tr:nth-child(29) {
            border-top: 0.16rem solid #515151;
        }

    </style>
    @yield('specific-css')
</head>

<body>
    @yield('content')

    {{-- default js --}}
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/plugins/icon/js/fontawesome.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alerts-css@1.0.1/assets/js/alerts.min.js"></script>
    <script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>
    {{-- end default js --}}
    @yield('specific-js')
</body>

</html>
