<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <meta name="author" content="#">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ env('APP_NAME') }} - {{ ucwords(request()->segment(count(request()->segments()))) }} </title>

    <!-- Favicon -->
    <link rel=" shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('js/extensions/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/extensions/css/toastr/toastr2.min.css') }}">


    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>


    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('js/auth/login.js') }}"></script>
    <script src="{{ asset('js/extensions/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>

    @stack('extended-css')
</head>

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        @yield('content')
    </div>
    <!-- /Main Wrapper -->

    @stack('extended-js')

</body>

</html>
