<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPT | {{ !isset($title) ? 'Page' : $title }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="baseurl" aria-valuemin="{{ url('/') }}">
    <meta name="token" content="{{ csrf_token() }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/devcss.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icon/css/all.min.css') }}">
    <!-- online style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alerts-css@1.0.2/assets/css/alerts-css.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css"
        integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- specific styling -->
    @yield('specific-css')
    <style>
        #log:hover {
            cursor: pointer;
        }

    </style>
</head>

<body>

    <div class="container-scroller bg-white">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
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
                    <li class="nav-item mb-4 d-flex align-items-center text-primary">
                        <i class="mdi mdi-account-circle display-3"></i>&nbsp;
                        <span class="menu-title display-5">{{ session('name') }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <i class="mdi mdi-apps menu-icon"></i>&nbsp;
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if (session('role') === 2)
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#data-master" aria-expanded="false"
                                aria-controls="data-master">
                                <i class="mdi mdi-folder menu-icon"></i>&nbsp;
                                <span class="menu-title">Master</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="data-master">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ url('/petani') }}">Petani</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ url('/pabrik') }}">PG</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ url('/user') }}">User</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ url('/pengirim') }}">Pengirim</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#data-transaksi" aria-expanded="false"
                            aria-controls="data-transaksi">
                            <i class="mdi mdi-folder menu-icon"></i>&nbsp;
                            <span class="menu-title">Transaksi</span>&nbsp;
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="data-transaksi">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('/entry') }}">Pengiriman Tebu</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/laporan') }}">
                            <i class="mdi mdi-file-chart menu-icon"></i>&nbsp;
                            <span class="menu-title">Laporan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/pembayaran') }}">
                            <i class="mdi mdi-view-list menu-icon"></i>&nbsp;
                            <span class="menu-title">Pembayaran</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="log">
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
    <script src="{{ asset('assets/js/function/Log.js') }}"></script>
    {{-- online script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"
        integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/alerts-css@1.0.1/assets/js/alerts.min.js"></script>
    {{-- definition script --}}
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
        });
    </script>
    {{-- end default js --}}
    @yield('specific-js')
</body>

</html>
