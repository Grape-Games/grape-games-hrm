@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal='false' />

    @can('is-admin')

        <x-dashboard-cards-first-admin-component />

        <x-dashboard-cards-second-admin-component />

        <x-statistics-component />

    @endcan

    @can('is-employee')

        @push('extended-js')

            <!-- Chart JS -->
            <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
            <script src="{{ asset('assets/js/chart.js') }}"></script>

        @endpush

        <x-dashboard-employee-first-component />

    @endcan

@endsection

@push('extended-js')
    <script>
        $(function() {
            var intervalId = window.setInterval(function() {
                $('#myChart-license-text').fadeOut('fast').css("display", "none !important;");
            }, 1000); // <-- time in milliseconds
        });
    </script>
    @if (session()->has('toast'))
        <script>
            makeToastr('success', '👋 Hello {{ $name }} welcome to the system !', 'User logged in successfully.')
        </script>
        {{ session()->forget('toast') }}
    @endif

@endpush
