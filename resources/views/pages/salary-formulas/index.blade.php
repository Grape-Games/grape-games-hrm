@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-table-view-emplyee-salary-formulas-component />

    <x-modal-add-employee-salary-component />
    <x-modal-employee-incrment-sheet-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/employees-salaries/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/employees-salaries/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
