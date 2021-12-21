@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Department Type" modalId="add_department_type" />

    <x-table-department-type-component />

    <x-modal-add-department-type />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/departments/department-type/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/departments/department-type/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
