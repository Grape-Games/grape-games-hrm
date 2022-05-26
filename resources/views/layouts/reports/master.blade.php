@extends('layouts.master')

@push('extended-css')
    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')
@endpush

@section('content')

@yield('content')

@endsection

@push('extended-js')
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/late-minutes/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
