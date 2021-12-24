@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Company" modalId="add_company" />

    <x-table-companies-component />

    <x-modal-add-company-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/companies/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/companies/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
