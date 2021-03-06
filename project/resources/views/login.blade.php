@extends('template.loginlayout')
@section('content')
    <div class="container-scroller">
        <!-- addslashes -->
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto err-msg">
                        <div class="msg">
                            @if (session('error') !== null)
                                <x-alert type="danger" message="{{ session('error') }}" />
                            @endif
                        </div>
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <h2 class="">Masuk</h2>
                            </div>
                            <h4>Selamat Datang..!</h4>
                            <h6 class="
                                    font-weight-light">Masuk untuk melanjutkan</h6>
                                    <form class="pt-3" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg" placeholder="Username"
                                                name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Password" name="password" required>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit"
                                                class="btn btn-block btn-success  btn-lg font-weight-medium auth-form-btn">Masuk</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
    @endsection
    @section('specific-js')
        <script src="{{ asset('assets/js/function/Auth.js') }}"></script>
    @endsection
