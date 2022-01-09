<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <meta name="author" content="#">
    <meta name="robots" content="#">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} - {{ ucwords(request()->segment(count(request()->segments()))) }} </title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">

    <!-- Boxicons CSS -->
    <link href='{{ asset('assets/css/boxicons.min.css') }}' rel='stylesheet'>

    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('extended-css')

</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <x-header-component />

        <x-side-bar-component />

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <!-- Page Content -->
            <div class="content container-fluid">

                @yield('content')

            </div>
            <!-- /Page Content -->

            <a href="#" class="mb-2" style="margin-left:1%"><i class="la la-copyright"
                    style="margin-right: 1%"></i>Powered by Fast
                Devs </a>

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/ajaxCall.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>



    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

    <!-- Chart JS -->
    {{-- <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/chart.js') }}"></script> --}}

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('extended-js')

</body>

</html>
