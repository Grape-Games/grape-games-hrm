@extends('layouts.master')

@push('extended-css')

    @include('vendors.select2')
    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Employee HRM Account" modalId="add_employee_hrm_account" />

    <x-table-employee-hrm-accounts-component />

    <x-modal-add-employee-hrm-account-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/employee-hrm/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/employee-hrm/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
