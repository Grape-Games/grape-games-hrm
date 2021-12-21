@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Designation" modalId="add_designation" />

    <x-table-designations-component />

    <x-modal-add-designation-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/designations/employees/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/designations/employees/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
