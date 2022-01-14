@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-search-salary-company-form />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/search-employee-salary/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/search-employee-salary/table.js') }}"></script>
@endpush
