@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Department" modalId="add_department" />

    <x-table-departments-component />

    <x-modal-add-department-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/departments/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/departments/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
