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
    <style>
        .pt-5 {
            padding-top: 7rem !important;
        }

        .menu-icon {
            margin: 0 1rem 0 0 !important;
        }

        nav.navbar.default-layout-navbar.col-lg-12.col-12.p-0.fixed-top.d-flex.flex-row {
            display: none !important;
        }

        .sidebar.sidebar-offcanvas.pt-5 {
            height: 100vh;
        }

        @media only screen and (max-width: 576px) {
            nav.navbar.default-layout-navbar.col-lg-12.col-12.p-0.fixed-top.d-flex.flex-row {
                display: flex !important;
                justify-content: flex-end;
            }

            .sidebar.sidebar-offcanvas.d-flex.align-items-center {
                align-items: flex-start;
            }

            .pt-5 {
                padding-top: 0rem !important;
            }
        }

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alerts-css@1.0.2/assets/css/alerts-css.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icon/css/all.min.css') }}">
    @yield('specific-css')
</head>

<body>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper p-0">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas pt-5" id="sidebar">
                <ul class="nav">
                    {{-- <li class="nav-item align-self-start">
                  <a class="nav-link" href="">
                    <h2>logo</h2>
                  </a>
              </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <i class="mdi mdi-apps menu-icon"></i>&nbsp;
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#data-master" aria-expanded="false" aria-controls="data-master">
                            <i class="mdi mdi-folder menu-icon"></i>&nbsp;
                            <span class="menu-title">Data Master</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="data-master">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('/petani') }}">Data Petani</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('/pabrik') }}">Data PG</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('/user') }}">Data User</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#data-transaksi" aria-expanded="false" aria-controls="data-transaksi">
                            <i class="mdi mdi-folder menu-icon"></i>&nbsp;
                            <span class="menu-title">Data Transaksi</span>&nbsp;
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="data-transaksi">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="">Data Transaksi</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-logout-variant menu-icon"></i>
                            <span class="menu-title">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
            @yield('content')
        </div>
    </div>
    {{-- default js --}}
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/plugins/icon/js/fontawesome.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alerts-css@1.0.1/assets/js/alerts.min.js"></script>
    <script>
        $(function() {
            var current = location.pathname;
            $(' li a').each(function() {
                var $this = $(this);
                // if the current path is like this link, make it active
                if ($this.attr('href').indexOf(current) !== -1) {
                    $this.addClass('active');
                }
            })
        })
    </script>
    {{-- end default js --}}
    @yield('specific-js')
</body>

</html>
